<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Outlet;
use App\Models\Pages;
use App\Models\Promo;
use App\Service\MailerService;
use App\Util\Constant;
use Illuminate\Http\Request;

class PageController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function landingpage()
    {
        return view('frontend.pages.anggun');
        return view('frontend.pages.anggun');
        return view('frontend.pages.anggun');
        return view('frontend.pages.anggun');
    }


    public function home(){
        $data['page'] = json_decode(Pages::where('types',Constant::PAGES_TYPES_HOME)->first()->content);
        $data['promos'] = Promo::active()->orderBy('valid_date','desc')->limit(6)->get();
        return view('frontend.pages.home',$data);
    }

    public function about(){
        $data['page'] = json_decode(Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first()->content);
        $data['outlets'] = Outlet::active()
                            ->select('province.image','outlets.province_id','province.name as province_name')
                            ->join('province','province.id','=','outlets.province_id')
                            ->orderBy('province.outlet_count','desc')
                            ->groupBy('outlets.province_id','province.image','province.name','province.outlet_count')
                            ->limit(3)
                            ->get();
        return view('frontend.pages.about',$data);
    }

    public function sendContact(Request $request)
    {
        $contact = new stdClass();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        MailerService::contact($contact);

        return view('frontend.pages.contact')->with('success','Terima kasih telah menghubungi kami');
    }
}



