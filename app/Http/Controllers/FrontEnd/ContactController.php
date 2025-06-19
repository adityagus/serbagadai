<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Contact;
use Illuminate\Http\Request;
use Validator;
use Response;

class ContactController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        return view('frontend.pages.contact');
    }

    public function send(Request $request)
    {
        $validate_rule = Contact::CONTACT_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = new Contact();

        foreach ($validate_rule as $key => $value){
            $data->$key = $request->$key;
        }

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }
}



