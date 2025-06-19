<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class PicController extends FrontEndController
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

    public function saveAccount(Request $request)
    {
        $validate_rule = array();
        //$validate_rule['email_profile'] = 'required|email';
        $validate_rule['name_profile'] = 'required';
        //$validate_rule['phone_profile'] = 'required';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = \Auth::user();
        $data->name = $request->name_profile;
        $data->email = $request->email_profile;
        $data->phone = $request->phone_profile;
        if($request->has('password_profile')){
            $data->password = bcrypt($request->password_profile);
        }

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }
    }
}
