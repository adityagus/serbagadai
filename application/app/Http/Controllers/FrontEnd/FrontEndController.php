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
        try {
            $CONF = Config::find(1);
            View::share('CONF',$CONF);
            $products = Product::active()
                ->where('title', 'not like', '%emas%')
                ->where('title', 'not like', '%logam%')
                ->where('slug', 'not like', '%emas%')
                ->orderBy('position','asc')
                ->get();
            View::share('products',$products);
            $pages = Pages::where('types',Constant::PAGES_TYPES_PRODUCT)->first();
            $product_config = $pages ? json_decode($pages->content) : null;
            View::share('product_config',$product_config);
        } catch (\Throwable $e) {
            View::share('CONF', null);
            View::share('products', collect([]));
            View::share('product_config', null);
        }
    }
}
