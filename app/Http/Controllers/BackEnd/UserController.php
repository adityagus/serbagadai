<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class UserController extends BackEndController
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
        $data['sidebar'] = 'user';
        return view('backend.user.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = array();
        $validate_rule['name'] = 'required';
        if($request->id == 0){
            $validate_rule['username'] = 'required|unique:users,username';
            $validate_rule['password'] = 'required';
        }
        $validate_rule['role'] = 'required';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            
            return response()->json($data);
        }

        $user = User::find($request->id);

        if(empty($user->id)){
            $user = new User();
        }

        if(!empty($request->password)){
            $user->password = \Hash::make($request->password);
        }

        $user->fill((array)$request->all());

        if($user->save()){
            return Response::json(array('status'=>true,'message'=>'Data account berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data account Gagal simpan, coba lagi'));
        }

    }

    public function detail($id){
        $data['sidebar'] = 'user';
        $data['model'] = User::find($id);
        return view('backend.user.detail',$data);
    }

    public function getUser($id){
        return Response::json(User::find($id));
    }

    public function indexData(Request $request){
      $users = User::orderBy('updated_at','desc')->get();

      return DataTables::of($users)
        ->editColumn('roles',function($user) {
          return Constant::USER_ROLES[$user->role];
        })
        ->addColumn('aksi',function($users) {
          return '<a href="'.route("admin.user.detail",["id"=>$users->id]).'" class="btn btn-success btn-xs">Detail</a>'.' '.'<a onclick="editData('.$users->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteData('.$users->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })
        ->filter(function ($instance) use ($request) {
            if ($request->has('username') && !empty($request->username)) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return Str::contains(strtoupper($row['username']), strtoupper($request->get('username'))) ? true : false;
                });
            }

            if ($request->has('name') && !empty($request->name)) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return Str::contains(strtoupper($row['name']), strtoupper($request->get('name'))) ? true : false;
                });
            }

            if ($request->has('email') && !empty($request->email) ) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return Str::contains(strtoupper($row['email']), strtoupper($request->get('email'))) ? true : false;
                });
            }


            if ($request->has('phone') && !empty($request->phone) ) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return Str::contains($row['phone'], $request->get('phone')) ? true : false;
                });
            }

            if ($request->has('role') && !empty($request->role) ) {
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return $row['role'] == $request->get('role') ? true : false;
                });
            }
        })
        ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $delete = User::find($id);
        $delete->deleted = 1;
        $delete->save();
    }

    public function export()
    {
        $users = User::get();

        $data['data'] = [
            'model'=>User::class,
            'items'=>$users
        ];

        $data['properties'] =[
            'title'=> 'Export Data User',
            'description'=> 'Data user',
        ];

        return Excel::download(new DataExport($data), 'export_user_'.time().'.xlsx');
    }

    public function search($query){
        return response()::json(
            User::where('username','like','%'.$query.'%')
                ->orWhere('name','like','%'.$query.'%')
                ->get()
        );
    }
}
