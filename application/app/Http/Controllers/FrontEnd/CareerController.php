<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Career;
use App\Models\CareerSubmission;
use App\Models\Location;
use App\Models\Pages;
use App\Util\Constant;
use Illuminate\Http\Request;
use Validator;
use Response;

class CareerController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $data['page'] = json_decode(Pages::where('types',Constant::PAGES_TYPES_CAREER)->first()->content);
        $data['locations'] = Location::get();
        $data['careers'] = Career::with('location')->active()->orderBy('created_at','desc')->limit(6)->get();
        return view('frontend.pages.career',$data);
    }

    public function loadMore(Request $request){
        $datas = Career::with('location')->active()->orderBy('created_at','desc');

        if(!empty($request->category)) $datas->where('category',$request->category);
        if(!empty($request->types)) $datas->where('types',$request->types);
        if(!empty($request->location)){
            $location = $request->location;
            $datas->whereHas('location',function ($query) use ($location){
               $query->where('location_id',$location);
            });
        }

        $total = $datas->count();
        $items = $datas
            ->offset(max(0, ((int)$request->offset - 1)))
            ->limit(6)
            ->get()
            ->map(function ($career) {
                $career->category_label = Constant::CAREER_CATEGORY_LIST[$career->category] ?? $career->category;
                $career->types_label = Constant::CAREER_TYPES_LIST[$career->types] ?? $career->types;
                $locNames = [];
                foreach ($career->location as $loc) {
                    $locNames[] = $loc->name;
                }
                $career->location_label = implode(', ', $locNames);
                return $career;
            });

        return response()->json([
            'total' => $total,
            'data' => $items,
        ]);
    }

    public function detail($slug = null){
        if (empty($slug)) return redirect()->route('career');
        $data['career'] = Career::with('location')->where('slug',$slug)->first();

        if(empty($data['career'])) return redirect()->route('career');

        $data['location'] = [];
        foreach ($data['career']->location as $location){
            $data['location'][] = $location->name;
        }

        $data['location'] = implode(', ',$data['location']);

        return view('frontend.pages.career-detail',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = CareerSubmission::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $checkSubmission = CareerSubmission::where(['email'=>$request->email,'career_id'=>$request->career_id])->exists();
        if($checkSubmission){
            $data['status'] = false;
            $data['message'] = 'Anda sudah melamar posisi ini!';

            return response()->json($data);
        }

        $data = new CareerSubmission();

        $data->fill((array)$request->all());

        $cv = 'career/submission/default.png';

        if ($request->hasFile('cv')) {
            $cv = $request->file('cv')->store('career/submission','public');
        }

        $data->cv = $cv;

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

}
