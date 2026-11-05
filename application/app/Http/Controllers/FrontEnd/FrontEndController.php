<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;

use App\Models\Config;
use App\Models\Pages;
use App\Models\Product;
use App\Util\Constant;
use View;

class FrontEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $CONF = Config::find(1);
        View::share('CONF',$CONF);
        $products = Product::active()
            ->where('title', 'not like', '%emas%')
            ->where('title', 'not like', '%logam%')
            ->where('slug', 'not like', '%emas%')
            ->orderBy('position','asc')
            ->get();
        View::share('products',$products);
        $product_config = json_decode(Pages::where('types',Constant::PAGES_TYPES_PRODUCT)->first()->content);
        View::share('product_config',$product_config);
    }
}
