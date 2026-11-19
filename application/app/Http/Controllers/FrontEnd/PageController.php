<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Outlet;
use App\Models\Pages;
use App\Models\Promo;
use App\Services\MailerService;
use App\Services\TaksiranService;
use App\Util\Constant;
use Illuminate\Http\Request;

class PageController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(){
        $data['page'] = json_decode(Pages::where('types',Constant::PAGES_TYPES_HOME)->first()->content);
        $data['promos'] = Promo::active()->orderBy('valid_date','desc')->limit(6)->get();
        $data['outlets'] = Outlet::with('province')->active()->get();
        return view('frontend.pages.home',$data);
    }

    public function simulasi(Request $request){
        $categories = TaksiranService::getCategories();
        $initialItems = TaksiranService::search('', '', 8);
        return view('frontend.pages.simulasi', compact('categories', 'initialItems'));
    }

    public function searchTaksiran(Request $request){
        // Security: Validation & Sanitization
        $validated = $request->validate([
            'jenis' => 'nullable|string|max:40',
            'nama'  => 'nullable|string|max:100',
            'kode'  => 'nullable|string|max:50',
        ]);

        $allowedCategories = ['all', 'smartphone', 'laptop', 'kamera', 'tv_audio', 'gadget'];
        $rawCategory = trim((string) ($validated['jenis'] ?? ''));
        $category = in_array($rawCategory, $allowedCategories, true) ? $rawCategory : '';

        // Sanitize search query: strip tags, remove unwanted control chars, trim
        $rawQuery = (string) ($validated['nama'] ?? '');
        $query = trim(strip_tags(preg_replace('/[\x00-\x1F\x7F]/u', '', $rawQuery)));
        $query = mb_substr($query, 0, 100);

        // Sanitize item code
        $rawCode = (string) ($validated['kode'] ?? '');
        $code = trim(strip_tags(preg_replace('/[\x00-\x1F\x7F]/u', '', $rawCode)));
        $code = mb_substr($code, 0, 50);

        $results = TaksiranService::search($category, $query, $code, 12);

        return response()->json([
            'status' => 'success',
            'count' => count($results),
            'data' => $results,
        ], 200, [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN',
        ]);
    }

    public function calculateCustomTaksiran(Request $request){
        // Security: Validation & Sanitization
        $validated = $request->validate([
            'price' => 'required|numeric|min:100000|max:500000000',
        ]);

        $price = (float) $validated['price'];
        $breakdown = TaksiranService::calculateGradeBreakdown($price);

        return response()->json([
            'status' => 'success',
            'data' => $breakdown,
        ], 200, [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN',
        ]);
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



