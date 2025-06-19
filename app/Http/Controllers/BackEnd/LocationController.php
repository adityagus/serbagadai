<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Location;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class LocationController extends BackEndController
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
        $data['sidebar'] = 'location';
        return view('backend.location.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Location::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            
            return response()->json($data);
        }

        $data = Location::find($request->id);

        if(empty($data->id)){
            $data = new Location();
        }

        $data->fill((array)$request->all());

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        $data = Location::find($id);
        return Response::json($data);
    }

    public function indexData(Request $request){
      $datas = Location::orderBy('id','asc');

        $filter = [
            'location.name'    => 'like',
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
        ->addColumn('action',function($data) {
          return '<a onclick="editData('.$data->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })
        ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $data = Location::find($id);

        $data->delete();
    }

    public function export()
    {
        $datas = Location::get();

        $result = [];

        foreach ($datas as $data){
            $result[] =[
                'id'=>$data->id,
                'name'=>$data->name,
            ];
        }

        $data['data'] = [
            'model'=>Location::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Location',
            'description'=> 'Data location',
        ];

        return Excel::download(new DataExport($data), 'export_location_'.time().'.xlsx');
    }
}
