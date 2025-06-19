<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromoController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $data['count_promo'] = Promo::active()->count();
        $data['promos'] = Promo::active()->orderBy('valid_date','desc')->limit(6)->get();
        return view('frontend.pages.promo',$data);
    }

    public function loadMore($offset){
        $datas = Promo::active()->offset(($offset-1))->limit(6)->get();
        foreach ($datas as $key => $data){
            $data->valid_date = Carbon::parse($data->valid_date)->format('d F Y');
            $datas[$key] = $data;
        }

        return response()->json($datas);
    }
}



