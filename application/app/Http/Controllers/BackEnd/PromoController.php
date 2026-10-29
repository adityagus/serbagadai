<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Promo;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class PromoController extends BackEndController
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
        $data['sidebar'] = 'promo';
        return view('backend.promo.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Promo::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            
            return response()->json($data);
        }

        $data = Promo::find($request->id);

        if(empty($data->id)){
            $data = new Promo();
        }

        $promo_image = @$data->image;

        if ($request->hasFile('image')) {
            $promo_image_file = $request->file('image');
            if(!empty($promo_image) && Storage::disk('public')->exists($promo_image)){
                Storage::disk('public')->delete($promo_image);
            }
            $promo_image = $promo_image_file->store('promo','public');
        }

        $data->fill((array)$request->all());

        $data->image = $promo_image;

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        $data = Promo::find($id);
        if(!empty($data->image)) $data->image = url('storage/'.@$data->image);
        return Response::json($data);
    }

    public function indexData(Request $request){
      $datas = Promo::orderBy('updated_at','desc');

        $filter = [
            'promos.title'    => 'like',
            'promos.status'   => '=',
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
        ->editColumn('image',function($data){
            return '<a href="'.url('storage/'.@$data->image).'" target="_blank" title="preview">
            <img src="'.url('storage/'.@$data->image).'" style="background-color: #e1e1e1" src="" width="100" height="100"></a>';
        })
        ->editColumn('action_link',function($data){
            return '<a target="_blank" class="alert-success" href="'.$data->action_link.'">'.$data->action_link.'</a>';
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
        $data = Promo::find($id);

        if(!empty($data->image) && Storage::disk('public')->exists($data->image)){
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();
    }

    public function export()
    {
        $datas = Promo::get();

        $result = [];

        foreach ($datas as $data){
            $result[] =[
                'title'=>$data->title,
                'valid_date'=>$data->valid_date,
                'action_link'=>$data->action_link,
                'status'=>Constant::COMMON_STATUS_LIST[$data->status],
                'image'=>Storage::disk('public')->url($data->image),
                'created_at'=> $data->created_at,
                'updated_at'=> $data->updated_at,
            ];
        }

        $data['data'] = [
            'model'=>Promo::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Promo',
            'description'=> 'Data promo',
        ];

        return Excel::download(new DataExport($data), 'export_promo_'.time().'.xlsx');
    }
}
