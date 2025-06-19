<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Config;
use App\Models\Pages;
use App\Util\Constant;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;
use Input;

class HomeController extends BackEndController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data['sidebar'] = 'home';
        $data['config'] = Config::find(1);
        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();
        $content = new \stdClass();
        if(!empty($home)) $content = json_decode($home->content);
        $data['content'] = $content;
        if(empty($content->hero_sliders)) $content->hero_sliders = [];
        if(empty($content->why_us)) $content->why_us = [];
        if(empty($content->testimony_sliders)) $content->testimony_sliders = [];
        return view('backend.pages.home.index',$data);
    }

    public function heroSave(Request $request)
    {
        $validate_rule = Pages::HOME_HERO_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();

        if(!empty($home)) $content = json_decode($home->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->$key;
        }

        $hero_background_image = $content->hero_background;

        if ($request->hasFile('hero_background')) {
            $hero_background = $request->file('hero_background');
            if(!empty($hero_background_image) && Storage::disk('public')->exists($hero_background_image)){
                Storage::disk('public')->delete($hero_background_image);
            }
            $hero_background_image = $hero_background->store('home/hero','public');
        }
        $content->hero_background = $hero_background_image;

        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function heroSliderSave (Request $request)
    {
        $validate_rule = array();
        $validate_rule['title'.$request->id] = 'required';
        $validate_rule['priority'.$request->id] = 'required';
        if(empty($request->id)){
            $validate_rule['image'.$request->id] = 'required|image';
        }

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            return response()->json($data);
        }

        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();
        if(!empty($home)) $content = json_decode($home->content);
        $sliders = !empty($content->hero_sliders) ? $content->hero_sliders : [];

        $sliderImage = 'home/hero/slider/default.png';

        if ($request->hasFile('image'.$request->id)) {
            $image = $request->file('image'.$request->id);
            $sliderImage = $image->store('home/hero/slider','public');
        }

        if($request->id ==0){
            $sliders[] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'image' => $sliderImage,
            ];
        }else{
            $id = $request->id - 1;
            $sliderImage = $sliders[$id]->image;
            if ($request->hasFile('image'.$request->id)) {
                $image = $request->file('image'.$request->id);
                if(!empty($sliderImage) && file_exists('storage/'.$sliderImage)){
                    unlink('storage/'.$sliderImage);
                }
                $sliderImage = $image->store('home/hero/slider','public');
            }

            $sliders[$id] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'image' => $sliderImage,
            ];
        }

         usort($sliders, function($a, $b) {
             if ($a->priority == $b->priority) {
                 return 0;
             }
             return ($a->priority < $b->priority) ? -1 : 1;
         });

        $content->hero_sliders = $sliders;
        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data slider berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data slider Gagal simpan, coba lagi'));
        }
    }

    public function heroSliderDelete(Request $request){
        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();

        if(!empty($home)) $content = json_decode($home->content);
        $request->id = $request->id - 1;
        $sliders = $content->hero_sliders;
        if(!empty($sliders[$request->id]->image) && file_exists('storage/'.$sliders[$request->id]->image)){
            unlink('storage/'.$sliders[$request->id]->image);
        }
        array_splice($sliders, $request->id,1);

        $content->hero_sliders = $sliders;
        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data slider berhasil dihapus'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data slider Gagal hapus, coba lagi'));
        }
    }

    public function aboutSave(Request $request)
    {
        $validate_rule = Pages::HOME_ABOUT_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();

        if(!empty($home)) $content = json_decode($home->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->post($key);
        }

        $about_image = @$content->about_image;

        if ($request->hasFile('about_image')) {
            $about_image_file = $request->file('about_image');
            if(!empty($about_image) && Storage::disk('public')->exists($about_image)){
                Storage::disk('public')->delete($about_image);
            }
            $about_image = $about_image_file->store('home/about','public');
        }
        $content->about_image = $about_image;

        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function productSave(Request $request)
    {
        $validate_rule = Pages::HOME_PRODUCT_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();

        if(!empty($home)) $content = json_decode($home->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->post($key);
        }

        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function whyUsSave (Request $request)
    {
        $validate_rule = array();
        $validate_rule['title'.$request->id] = 'required';
        $validate_rule['priority'.$request->id] = 'required';
        $validate_rule['description'.$request->id] = 'required';
        if(empty($request->id)){
            $validate_rule['image'.$request->id] = 'required|image';
        }

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            return response()->json($data);
        }

        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();
        if(!empty($home)) $content = json_decode($home->content);
        $sliders = !empty($content->why_us) ? $content->why_us : [];

        $sliderImage = 'home/why_us/default.png';

        if ($request->hasFile('image'.$request->id)) {
            $image = $request->file('image'.$request->id);
            $sliderImage = $image->store('home/why_us','public');
        }

        if($request->id ==0){
            $sliders[] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'description' => $request->post('description'.$request->id),
                'image' => $sliderImage,
            ];
        }else{
            $id = $request->id - 1;
            $sliderImage = $sliders[$id]->image;
            if ($request->hasFile('image'.$request->id)) {
                $image = $request->file('image'.$request->id);
                if(!empty($sliderImage) && file_exists('storage/'.$sliderImage)){
                    unlink('storage/'.$sliderImage);
                }
                $sliderImage = $image->store('home/why_us','public');
            }

            $sliders[$id] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'description' => $request->post('description'.$request->id),
                'image' => $sliderImage,
            ];
        }

        usort($sliders, function($a, $b) {
            if ($a->priority == $b->priority) {
                return 0;
            }
            return ($a->priority < $b->priority) ? -1 : 1;
        });

        $content->why_us = $sliders;
        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function whyUsDelete(Request $request){
        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();

        if(!empty($home)) $content = json_decode($home->content);
        $request->id = $request->id - 1;
        $sliders = $content->why_us;
        if(!empty($sliders[$request->id]->image) && file_exists('storage/'.$sliders[$request->id]->image)){
            unlink('storage/'.$sliders[$request->id]->image);
        }
        array_splice($sliders, $request->id,1);

        $content->why_us = $sliders;
        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil dihapus'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal hapus, coba lagi'));
        }
    }

    public function testimonySave(Request $request)
    {
        $validate_rule = Pages::HOME_TESTIMONY_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();

        if(!empty($home)) $content = json_decode($home->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->$key;
        }

        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function testimonySliderSave (Request $request)
    {
        $validate_rule = array();
        $validate_rule['title'.$request->id] = 'required';
        $validate_rule['role'.$request->id] = 'required';
        $validate_rule['star'.$request->id] = 'required';
        $validate_rule['content'.$request->id] = 'required';
        $validate_rule['priority'.$request->id] = 'required';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();
            return response()->json($data);
        }

        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();
        if(!empty($home)) $content = json_decode($home->content);
        $sliders = !empty($content->testimony_sliders) ? $content->testimony_sliders : [];

        $item = (object)[
            'title' => $request->post('title'.$request->id),
            'role' => $request->post('role'.$request->id),
            'star' => $request->post('star'.$request->id),
            'content' => $request->post('content'.$request->id),
            'priority' => $request->post('priority'.$request->id),
        ];

        if($request->id ==0){
            $sliders[] = $item;
        }else{
            $id = $request->id - 1;
            $sliders[$id] = $item;
        }

        usort($sliders, function($a, $b) {
            if ($a->priority == $b->priority) {
                return 0;
            }
            return ($a->priority < $b->priority) ? -1 : 1;
        });

        $content->testimony_sliders = $sliders;
        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function testimonySliderDelete(Request $request){
        $home = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();

        if(!empty($home)) $content = json_decode($home->content);
        $request->id = $request->id - 1;
        $sliders = $content->testimony_sliders;
        array_splice($sliders, $request->id,1);
        $content->testimony_sliders = $sliders;
        $home->content = json_encode($content);

        if($home->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil dihapus'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal hapus, coba lagi'));
        }
    }
}
