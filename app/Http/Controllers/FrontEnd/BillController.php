<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontEnd\FrontEndController;

class BillController extends FrontEndController
{
   public function __construct()
    {
        parent::__construct();
    }
  
    public function index (){
      return view('frontend.pages.bill');
    }
}
