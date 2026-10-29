<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Models\Contact;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class ContactController extends BackEndController
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
        $data['sidebar'] = 'contact';
        return view('backend.contact.index',$data);
    }

    public function getData($id){
        return Response::json(Contact::where('id',$id)->first());
    }

    public function indexData(Request $request){
        $datas = Contact::orderBy('updated_at','desc');

        $filter = [
            'contacts.name'    => 'like',
            'contacts.email'   => 'like',
            'contacts.phone'   => 'like',
            'contacts.content'   => 'like',
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
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at',function($data){
                return $data->updated_at->format('Y-m-d H:i:s');
            })
            ->escapeColumns([])->make(true);
    }

    public function export()
    {
        $datas = Contact::get();

        $result = [];

        foreach ($datas as $data){
            $result[] = (object)[
                'name'=>$data->name,
                'email'=>$data->email,
                'phone'=>$data->phone,
                'content'=>$data->content,
                'created_at'=> $data->created_at,
                'updated_at'=> $data->updated_at,
            ];
        }

        $data['data'] = [
            'model'=>Contact::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Contact',
            'description'=> 'Data contact',
        ];

        return Excel::download(new DataExport($data), 'export_contact_'.time().'.xlsx');
    }
}
