<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Pages;
use App\Models\Product;
use App\Models\User;
use App\Util\Constant;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function shareFrontendData()
    {
        $CONF = Config::find(1);
        View::share('CONF', $CONF);

        $products = Product::active()
            ->where('title', 'not like', '%emas%')
            ->where('title', 'not like', '%logam%')
            ->where('slug', 'not like', '%emas%')
            ->orderBy('position', 'asc')
            ->get();
        View::share('products', $products);

        $productPage = Pages::where('types', Constant::PAGES_TYPES_PRODUCT)->first();
        $product_config = $productPage ? json_decode($productPage->content) : null;
        View::share('product_config', $product_config);
    }

    public function index()
    {
        $this->shareFrontendData();
        return view('auth.frontend.register');
    }

    public function showRegistrationForm()
    {
        $this->shareFrontendData();
        return view('auth.frontend.register');
    }

    /**
     * Save newly registered user to the users table (AJAX / POST).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $validation = $this->validator($request->all());

        if ($validation->fails()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Periksa Data Kembali!',
                    'error' => $validation->errors(),
                ]);
            }

            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = $this->create($request->all());

        if ($user && $user->id) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Pendaftaran akun berhasil disimpan',
                ]);
            }

            return redirect()->route('admin.login')->with('status', 'Pendaftaran akun berhasil disimpan');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => false,
                'message' => 'Data akun gagal disimpan, silakan coba lagi',
            ]);
        }

        return redirect()->back()->withInput();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:30',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->username = $data['username'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;
        $user->role = !empty($data['role']) ? $data['role'] : Constant::USER_ROLE_ADMIN;
        $user->password = Hash::make($data['password']);
        $user->deleted = 0;
        $user->save();

        return $user;
    }
}
