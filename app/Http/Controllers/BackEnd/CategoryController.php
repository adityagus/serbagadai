<?php

namespace App\Http\Controllers\BackEnd;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class CategoryController extends BackEndController
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
        $data['sidebar'] = 'category';
        $data['model'] = Category::class;
        return view('backend.category.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = array();

        foreach (Category::FORM_VALIDATION as $key => $value){
            $validate_rule[$key] = $value;
        }

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = Category::find($request->id);

        if(empty($data->id)){
            $data = new Category();
            $data->image = 'products/default.png';
        }

        $data->fill((array)$request->all());

        $categoryImage = $data->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if(!empty($categoryImage) && file_exists('storage/'.$categoryImage)){
                unlink('storage/'.$categoryImage);
            }
            $categoryImage = $image->store('categories','public');
        }

        $data->image = $categoryImage;

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        return Response::json(Category::find($id));
    }

    public function indexData(Request $request){
        $datas = Category::orderBy('name','asc')->get();

        return DataTables::of($datas)
            ->addColumn('aksi',function($data) {
                return '<a onclick="editData('.$data->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->filter(function ($instance) use ($request) {
                if ($request->has('name') && !empty($request->name)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains(strtoupper($row['name']), strtoupper($request->get('name'))) ? true : false;
                    });
                }

                if ($request->has('description') && !empty($request->description) ) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['description'], $request->get('description')) ? true : false;
                    });
                }
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $delete = Category::find($id);
        $delete->deleted = 1;
        $delete->save();
    }

    public function export()
    {
        return Excel::create( 'export_category_'.time() , function($excel) {

            // Set the title
            $excel->setTitle('Export Data Category');

            // Call them separately
            $excel->setDescription('Data category');

            $datas = Category::all();

            $excel->sheet('category', function($sheet) use ($datas) {

                // Sheet manipulation
                $sheet->loadView('backend.part.export',['datas'=>$datas,'model'=>Category::class]);

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
}
