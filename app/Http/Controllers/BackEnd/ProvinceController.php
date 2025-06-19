<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Province;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class ProvinceController extends BackEndController
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
        $data['sidebar'] = 'province';
        return view('backend.province.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Province::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            
            return response()->json($data);
        }

        $data = Province::find($request->id);

        if(empty($data->id)){
            $data = new Province();
        }

        $province_image = @$data->image;

        if ($request->hasFile('image')) {
            $province_image_file = $request->file('image');
            if(!empty($province_image) && Storage::disk('public')->exists($province_image)){
                Storage::disk('public')->delete($province_image);
            }
            $province_image = $province_image_file->store('province','public');
        }

        $data->fill((array)$request->all());

        $data->image = $province_image;

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        $data = Province::find($id);
        if(!empty($data->image)) $data->image = url('storage/'.@$data->image);
        return Response::json($data);
    }

    public function indexData(Request $request){
      $datas = Province::orderBy('id','asc');

        $filter = [
            'province.id'    => 'like',
            'province.name'    => 'like',
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
        ->editColumn('image',function($data){
            return '<a href="'.url('storage/'.@$data->image).'" target="_blank" title="preview">
            <img src="'.url('storage/'.@$data->image).'" style="background-color: #e1e1e1" src="" width="100" height="100"></a>';
        })
        ->addColumn('action',function($data) {
          return '<a onclick="editData(`'.$data->id.'`)" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteData(`'.$data->id.'`)"class="btn btn-danger btn-xs">Delete</a>';
        })
        ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $data = Province::find($id);

        if(!empty($data->image) && Storage::disk('public')->exists($data->image) && $data->image != 'province/default.png'){
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();
    }

    public function export()
    {
        $datas = Province::get();

        $result = [];

        foreach ($datas as $data){
            $result[] =[
                'id'=>$data->id,
                'name'=>$data->name,
                'image'=>$data->image,
            ];
        }

        $data['data'] = [
            'model'=>Province::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Province',
            'description'=> 'Data province',
        ];

        return Excel::download(new DataExport($data), 'export_province_'.time().'.xlsx');
    }
}
