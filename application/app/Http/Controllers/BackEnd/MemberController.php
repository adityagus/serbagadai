<?php

namespace App\Http\Controllers\BackEnd;

use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class MemberController extends BackEndController
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
        $data['sidebar'] = 'member';
        $data['model'] = Member::class;
        return view('backend.member.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = array();

        foreach (Member::FORM_VALIDATION as $key => $value){
            $validate_rule[$key] = $value;
        }

        if($request->id == 0){
            $validate_rule['email'] = 'required|unique:members,email|email';
        }

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = Member::find($request->id);

        if(empty($data->id)){
            $data = new Member();
        }

        $data->fill((array)$request->all());

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        return Response::json(Member::find($id));
    }

    public function indexData(Request $request){
        $datas = Member::orderBy('updated_at','desc')->get();

        return DataTables::of($datas)
            ->addColumn('types',function($data) {
                return Constant::MEMBER_TYPES_LIST[$data->types];
            })
            ->addColumn('aksi',function($data) {
                return '<a onclick="editData('.$data->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->filter(function ($instance) use ($request) {
                if ($request->has('email') && !empty($request->email)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains(strtoupper($row['email']), strtoupper($request->get('email'))) ? true : false;
                    });
                }

                if ($request->has('name') && !empty($request->name)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains(strtoupper($row['name']), strtoupper($request->get('name'))) ? true : false;
                    });
                }

                if ($request->has('phone') && !empty($request->phone) ) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['phone'], $request->get('phone')) ? true : false;
                    });
                }

                if ($request->has('address') && !empty($request->address) ) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['address'], $request->get('address')) ? true : false;
                    });
                }

                if ($request->has('types') && !empty($request->types) ) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return $row['types'] == $request->get('types') ? true : false;
                    });
                }
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $delete = Member::find($id);
        $delete->deleted = 1;
        $delete->save();
    }

    public function export()
    {
        return Excel::create( 'export_member_'.time() , function($excel) {

            // Set the title
            $excel->setTitle('Export Data Member');

            // Call them separately
            $excel->setDescription('Data member');

            $datas = Member::all();

            $excel->sheet('member', function($sheet) use ($datas) {

                foreach ($datas as $key => $data){
                    $datas[$key]->types = Constant::MEMBER_TYPES_LIST[$data->types];
                }

                // Sheet manipulation
                $sheet->loadView('backend.part.export',['datas'=>$datas,'model'=>Member::class]);

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Times New Roman',
                        'size'      =>  12,
                    )
                ));
            });

        })
        // ;
        ->download('xls');
    }

    public function search($query){
        return Response::json(
            Member::where('phone','like','%'.$query.'%')
                ->orWhere('name','like','%'.$query.'%')
                ->get()
        );
    }
}
