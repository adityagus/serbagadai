<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($slug){
        $data['product'] = Product::where('slug',$slug)->first();
        return view('frontend.pages.product',$data);
    }
}



