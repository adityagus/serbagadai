<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Models\Outlet;
use App\Models\Province;
use App\Util\Constant;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class OutletController extends BackEndController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sidebar'] = 'outlet';
        $data['provinces'] = Province::get();
        return view('backend.outlet.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Outlet::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = Outlet::find($request->id);

        if(empty($data->id)){
            $data = new Outlet();
        }

        $data->fill((array)$request->all());

        if($data->save()){

            $this->count_outlet($request->province_id);

            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        return Response::json(Outlet::with(['province'])->where('id',$id)->first());
    }

    public function indexData(Request $request){
        $datas = Outlet::orderBy('updated_at','desc');
        $datas->with(['province']);

        $filter = [
            'outlets.name'    => 'like',
            'outlets.province_id'   => '=',
            'outlets.status'   => '=',
        ];

        foreach ($filter as $key => $operator) {
            $key_attributes = $key;
            $key = str_replace('.','_',$key);
            if (!empty($request->$key)) {
                if ($operator == 'like') {
                    $datas->where($key_attributes, $operator, '%' . $request->$key . '%');
                } else {
                    $datas->where($key_attributes, $operator, $request->$key);
                }
            }
        }

        return DataTables::of($datas->get())
            ->editColumn('status',function($data) {
                return '<label class="label label-'.Constant::COMMON_STATUS_LABEL_LIST[$data->status].'">'.Constant::COMMON_STATUS_LIST[$data->status].'</label>';
            })
            ->editColumn('province_id',function($data){
                return @$data->province->name;
            })
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at',function($data){
                return $data->updated_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action',function($data) {
                return '<a onclick="editData('.$data->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $data = Outlet::find($id);
        $province_id = $data->province_id;
        $data->delete();
        $this->count_outlet($province_id);
    }

    public function export()
    {
        $datas = Outlet::with(['province'])->get();

        $result = [];

        foreach ($datas as $data){
            $result[] = (object)[
                'name'=>$data->name,
                'province_id'=> $data->province_id,
                'province_name'=> @$data->province->name,
                'address'=>$data->address,
                'status'=>Constant::COMMON_STATUS_LIST[$data->status],
                'created_at'=> $data->created_at,
                'updated_at'=> $data->updated_at,
            ];
        }

        $data['data'] = [
            'model'=>Outlet::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Outlet',
            'description'=> 'Data outlet',
        ];

        return Excel::download(new DataExport($data), 'export_outlet_'.time().'.xlsx');
    }

    public function count_outlet($province_id){
        $outlet_count = Outlet::where('province_id',$province_id)->count();
        $province = Province::where('id',$province_id)->first();
        $province->outlet_count = $outlet_count;
        return $province->save();
    }
}
