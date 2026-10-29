<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Career;
use App\Models\CareerSubmission;
use App\Models\Contact;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Promo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View;
use App\Models\Config;
use App\Util\Constant;

class BackEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $constant = Constant::class;

    public function __construct()
    {
        $CONF = Config::find(1);
        View::share('CONF',$CONF);
        $notification = \App\Helpers\SelectHelper::getNotification();
        View::share('notification',$notification);
    }

    public function login(){
        return view('auth.backend.login');
    }

    public function dashboard()
    {
        $data['sidebar'] = 'dashboard';
        $data['product'] = Product::active()->count();
        $data['promo'] = Promo::active()->count();
        $data['article'] = Article::active()->count();
        $data['career'] = Career::active()->count();
        $data['career_submission'] = CareerSubmission::count();
        $data['contact'] = Contact::count();
        $data['outlet'] = Outlet::active()->count();

        return view('backend.pages.dashboard',$data);
    }
}
