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

    public function services()
    {
        return view('frontend.pages.services');
    }

    public function index($slug = null)
    {
        if (empty($slug)) {
            return view('frontend.pages.services');
        }
        $data['product'] = Product::where('slug', $slug)->first();
        if (empty($data['product'])) {
            return redirect()->route('services');
        }
        return view('frontend.pages.product', $data);
    }
}
