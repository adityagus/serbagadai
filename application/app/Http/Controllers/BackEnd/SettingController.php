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

class SettingController extends BackEndController
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
        $data['sidebar'] = 'general';
        $data['model'] = Config::find(1);
        return view('backend.setting.detail',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Config::FORM_VALIDATION_DETAIL;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $config = Config::find($request->idSetting);
        $logoImage = $config->logo;
        $logoSecondImage = $config->logoSecond;
        $iconImage = $config->icon;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            if(!empty($logoImage) && Storage::disk('config')->exists($logoImage)){
                Storage::disk('config')->delete($logoImage);
            }
            $logoImage = $logo->store('config','config');
        }

        if ($request->hasFile('logoSecond')) {
            $logoSecond = $request->file('logoSecond');
            if(!empty($logoSecondImage) && Storage::disk('config')->exists($logoSecondImage)){
                Storage::disk('config')->delete($logoSecondImage);
            }
            $logoSecondImage = $logoSecond->store('config','config');
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            if(!empty($iconImage) && Storage::disk('config')->exists($iconImage)){
                Storage::disk('config')->delete($iconImage);
            }
            $iconImage = $icon->store('config','config');
        }

        $config->fill((array)$request->all());
        $config->logo = $logoImage;
        $config->logoSecond = $logoSecondImage;
        $config->icon = $iconImage;

        if($config->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function about()
    {
        $data['sidebar'] = 'setting';
        $data['config'] = Config::find(1);
        return view('backend.setting.about',$data);
    }

    public function faq()
    {
        $data['sidebar'] = 'setting';
        $data['config'] = Config::find(1);
        return view('backend.setting.faq',$data);
    }

    public function slider()
    {
        $data['sidebar'] = 'setting';
        $data['config'] = Config::find(1);
        return view('backend.setting.slider',$data);
    }

    public function bank()
    {
        $data['sidebar'] = 'setting';
        $data['config'] = Config::find(1);
        return view('backend.setting.bank',$data);
    }

    public function aboutSave(Request $request)
    {
        $validate_rule = array();
        $validate_rule['title'] = 'required';
        $validate_rule['header1'] = 'required';
        $validate_rule['content1'] = 'required';
        $validate_rule['header2'] = 'required';
        $validate_rule['content2'] = 'required';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $config = Config::find($request->idSetting);
        $about = json_decode($config->aboutDetail);
        $bannerImage = $about->banner;
        $image1Image = $about->image1;
        $image2Image = $about->image2;

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            if(!empty($bannerImage) && file_exists('storage/'.$bannerImage)){
                unlink('storage/'.$bannerImage);
            }
            $bannerImage = $banner->store('config','public');
        }

        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            if(!empty($image1Image) && file_exists('storage/'.$image1Image)){
                unlink('storage/'.$image1Image);
            }
            $image1Image = $image1->store('config','public');
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            if(!empty($image2Image) && file_exists('storage/'.$image2Image)){
                unlink('storage/'.$image2Image);
            }
            $image2Image = $image2->store('config','public');
        }

        $about->title = $request->title;
        $about->banner = $bannerImage;
        $about->header1 = $request->header1;
        $about->image1 = $image1Image;
        $about->content1 = $request->content1;
        $about->header2 = $request->header2;
        $about->image2 = $image2Image;
        $about->content2 = $request->content2;

        $config->aboutDetail = json_encode($about);

        if($config->save()){
            return Response::json(array('status'=>true,'message'=>'Data Pengaturan berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Pengaturan Gagal simpan, coba lagi'));
        }
    }

    public function faqSave(Request $request)
    {
        $validate_rule = array();
        $validate_rule['title'] = 'required';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $config = Config::find($request->idSetting);
        $faq = json_decode($config->faq);
        $bannerImage = $faq->banner;

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            if(!empty($bannerImage) && file_exists('storage/'.$bannerImage)){
                unlink('storage/'.$bannerImage);
            }
            $bannerImage = $banner->store('config','public');
        }

        $faq->title = $request->title;
        $faq->banner = $bannerImage;
        $listQuestion = [];

        foreach ($request->question as $key => $question){
            $listQuestion [] = [
                'title' => $question,
                'content' => $request->answer[$key],
            ];
        }

        $faq->list = $listQuestion;

        $config->faq = json_encode($faq);

        if($config->save()){
            return Response::json(array('status'=>true,'message'=>'Data Pengaturan berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Pengaturan Gagal simpan, coba lagi'));
        }
    }

    public function sliderSave (Request $request)
    {
        $validate_rule = array();
        $validate_rule['title'] = 'required';
        if(empty($request->id)){
            $validate_rule['image'] = 'required|image';
        }

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $config = Config::find(1);
        $sliders = json_decode($config->slider);

        if($request->id ==0){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $sliderImage = $image->store('config/slider','public');
            }

            $sliders[] = [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $sliderImage,
                'link' => $request->link,
                'linkText' => $request->linkText,
            ];
        }else{
            $request->id = $request->id -1;
            $sliderImage = $sliders[$request->id]->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                if(!empty($sliderImage) && file_exists('storage/'.$sliderImage)){
                    //unlink('storage/'.$sliderImage);
                }
                $sliderImage = $image->store('config/slider','public');
            }

            $sliders[$request->id] = [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $sliderImage,
                'link' => $request->link,
                'linkText' => $request->linkText,
            ];
        }

        $config->slider = json_encode($sliders);

        if($config->save()){
            return Response::json(array('status'=>true,'message'=>'Data Pengaturan berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Pengaturan Gagal simpan, coba lagi'));
        }
    }

    public function SliderDelete(Request $request){
        $config = Config::find(1);
        $sliders = json_decode($config->slider);
        if(!empty($sliders[$request->id]->image) && file_exists('storage/'.$sliders[$request->id]->image)){
            unlink('storage/'.$sliders[$request->id]->image);
        }
        array_splice($sliders, $request->id,1);
        $config->slider = json_encode($sliders);
        $config->save();
    }

    public function bankSave(Request $request)
    {
        $validate_rule = array();
        $validate_rule['bank'] = 'required';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $config = Config::find($request->idSetting);
        $banks = [];

        foreach ($request->bank as $key => $bank){
            $banks [] = [
                'bank' => $request->bank[$key],
                'number' => $request->number[$key],
                'account' => $request->account[$key],
            ];
        }

        $config->bank = json_encode($banks);

        if($config->save()){
            return Response::json(array('status'=>true,'message'=>'Data Pengaturan berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Pengaturan Gagal simpan, coba lagi'));
        }
    }

    public function home()
    {
        $data['sidebar'] = 'home';
        $data['config'] = Config::find(1);
        $data['home'] = Pages::where('types',Constant::PAGES_TYPES_HOME)->first();
        if(!empty($data['home'])) $data['home'] = json_decode($data['home']->content);
        return view('backend.setting.home',$data);
    }
}
