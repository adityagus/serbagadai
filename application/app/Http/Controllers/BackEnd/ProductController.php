<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Models\Config;
use App\Models\Pages;
use App\Services\CommonService;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class ProductController extends BackEndController
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
        $data['sidebar'] = 'product';
        return view('backend.product.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Product::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = Product::find($request->id);

        if(empty($data->id)){
            $data = new Product();
        }

        $data->fill((array)$request->all());

        $product_icon = @$data->icon;

        if ($request->hasFile('icon')) {
            $icon_file = $request->file('icon');
            if(!empty($product_icon) && Storage::disk('public')->exists($product_icon)){
                Storage::disk('public')->delete($product_icon);
            }
            $product_icon = $icon_file->store('product','public');
        }

        $data->icon = $product_icon;

        $product_image = @$data->image;

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            if(!empty($product_image) && Storage::disk('public')->exists($product_image)){
                Storage::disk('public')->delete($product_image);
            }
            $product_image = $image_file->store('product','public');
        }

        $data->image = $product_image;
        $data->slug = CommonService::createSlug($request->title);

        $advantages = json_decode($request->advantages);
        usort($advantages, function($a, $b) {
            if ($a->priority == $b->priority) {
                return 0;
            }
            return ($a->priority < $b->priority) ? -1 : 1;
        });

        $data->advantages = json_encode($advantages);

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan','data'=>$data->id));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

    public function detail($id){
        $data['sidebar'] = 'product';
        $data['model'] = !empty($id) ? Product::find($id) : Product::class;
        $data['advantages'] = !empty($data['model']->advantages) ? json_decode($data['model']->advantages) : [];
        return view('backend.product.detail',$data);
    }

    public function indexData(Request $request){
        $datas = Product::orderBy('updated_at','desc');

        $filter = [
            'products.title'    => 'like',
            'products.short_description'    => 'like',
            'products.status'   => '=',
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
            ->editColumn('icon',function($data){
                return '<a href="'.url('storage/'.@$data->icon).'" target="_blank" title="preview">
            <img src="'.url('storage/'.@$data->icon).'" style="background-color: #e1e1e1" src="" width="100" height="100"></a>';
            })
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at',function($data){
                return $data->updated_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action',function($data) {
                return '<a href="'.route('admin.product.detail',['id'=>$data->id]).'"class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $data = Product::find($id);

        if(!empty($data->icon) && Storage::disk('public')->exists($data->icon)){
            Storage::disk('public')->delete($data->icon);
        }

        if(!empty($data->image) && Storage::disk('public')->exists($data->image)){
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();
    }

    public function export()
    {
        $datas = Product::get();

        $result = [];

        foreach ($datas as $data){
            $result[] =[
                'title'=>$data->title,
                'slug'=>$data->slug,
                'short_description'=>$data->short_description,
                'status'=>Constant::COMMON_STATUS_LIST[$data->status],
                'created_at'=> $data->created_at,
                'updated_at'=> $data->updated_at,
            ];
        }

        $data['data'] = [
            'model'=>Product::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Product',
            'description'=> 'Data product',
        ];

        return Excel::download(new DataExport($data), 'export_product_'.time().'.xlsx');
    }

    public function setting()
    {
        $data['sidebar'] = 'setting-product';
        $data['config'] = Config::find(1);
        $page = Pages::where('types',Constant::PAGES_TYPES_PRODUCT)->first();
        $content = new \stdClass();
        if(!empty($page)) $content = json_decode($page->content);
        $data['content'] = $content;
        return view('backend.pages.product.index',$data);
    }

    public function settingSave(Request $request)
    {
        $validate_rule = Pages::PRODUCT_GENERAL_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $page = Pages::where('types',Constant::PAGES_TYPES_PRODUCT)->first();

        if(!empty($page)) $content = json_decode($page->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->$key;
        }

        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }
}
