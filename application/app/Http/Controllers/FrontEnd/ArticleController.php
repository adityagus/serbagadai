<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $data['count_article'] = Article::active()->count();
        $data['articles'] = Article::active()->orderBy('created_at','desc')->limit(6)->get();
        return view('frontend.pages.article',$data);
    }

    public function loadMore($offset){
        $datas = Article::active()->orderBy('created_at','desc')->offset(($offset-1))->limit(6)->get();
        foreach ($datas as $key => $data){
            $data->date = Carbon::parse($data->created_at)->format('d F Y');
            $data->excerpt = Str::limit(strip_tags($data->content), 140);
            $datas[$key] = $data;
        }

        return response()->json($datas);
    }

    public function detail($slug = null){
        if (empty($slug)) return redirect()->route('article');
        $data['article'] = Article::where('slug',$slug)->first();
        if(empty($data['article'])) return redirect()->route('article');
        $data['random_article'] = Article::active()
            ->where('id','!=',$data['article']->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view('frontend.pages.article-detail',$data);
    }
}
