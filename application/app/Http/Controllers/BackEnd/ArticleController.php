<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Services\CommonService;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class ArticleController extends BackEndController
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
        $data['sidebar'] = 'article';
        return view('backend.article.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Article::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            
            return response()->json($data);
        }

        $data = Article::find($request->id);

        if(empty($data->id)){
            $data = new Article();
        }

        $data->fill((array)$request->all());

        $article_featured_image = @$data->featured_image;

        if ($request->hasFile('featured_image')) {
            $article_featured_image_file = $request->file('featured_image');
            if(!empty($article_featured_image) && Storage::disk('public')->exists($article_featured_image)){
                Storage::disk('public')->delete($article_featured_image);
            }
            $article_featured_image = $article_featured_image_file->store('article','public');
        }

        $data->featured_image = $article_featured_image;

        $article_banner_image = @$data->banner_image;

        if ($request->hasFile('banner_image')) {
            $article_banner_image_file = $request->file('banner_image');
            if(!empty($article_banner_image) && Storage::disk('public')->exists($article_banner_image)){
                Storage::disk('public')->delete($article_banner_image);
            }
            $article_banner_image = $article_banner_image_file->store('article','public');
        }

        $data->banner_image = $article_banner_image;
        $data->slug = CommonService::createSlug($request->title);

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan','data'=>$data->id));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

    public function detail($id){
        $data['sidebar'] = 'article';
        $data['model'] = !empty($id) ? Article::find($id) : Article::class;
        return view('backend.article.detail',$data);
    }

    public function indexData(Request $request){
      $datas = Article::orderBy('updated_at','desc');

        $filter = [
            'articles.title'    => 'like',
            'articles.status'   => '=',
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
        ->editColumn('featured_image',function($data){
            return '<a href="'.url('storage/'.@$data->featured_image).'" target="_blank" title="preview">
            <img src="'.url('storage/'.@$data->featured_image).'" style="background-color: #e1e1e1" src="" width="100" height="100"></a>';
        })
          ->editColumn('created_at',function($data){
              return $data->created_at->format('Y-m-d H:i:s');
          })
          ->editColumn('updated_at',function($data){
              return $data->updated_at->format('Y-m-d H:i:s');
          })
        ->addColumn('action',function($data) {
          return '<a href="'.route('admin.article.detail',['id'=>$data->id]).'"class="btn btn-info btn-xs">Edit</a>'.' '.
          '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
        })
        ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $data = Article::find($id);

        if(!empty($data->featured_image) && Storage::disk('public')->exists($data->featured_image)){
            Storage::disk('public')->delete($data->featured_image);
        }

        if(!empty($data->banner_image) && Storage::disk('public')->exists($data->banner_image)){
            Storage::disk('public')->delete($data->banner_image);
        }

        $data->delete();
    }

    public function export()
    {
        $datas = Article::get();

        $result = [];

        foreach ($datas as $data){
            $result[] =[
                'title'=>$data->title,
                'slug'=>$data->slug,
                'status'=>Constant::COMMON_STATUS_LIST[$data->status],
                'created_at'=> $data->created_at,
                'updated_at'=> $data->updated_at,
            ];
        }

        $data['data'] = [
            'model'=>Article::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Article',
            'description'=> 'Data article',
        ];

        return Excel::download(new DataExport($data), 'export_article_'.time().'.xlsx');
    }
}
