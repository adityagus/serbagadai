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

class AboutController extends BackEndController
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
        $data['sidebar'] = 'about';
        $data['config'] = Config::find(1);
        $about = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();
        $content = new \stdClass();
        if(!empty($about)) $content = json_decode($about->content);
        if(empty($content->values)) $content->values = [];
        if(empty($content->activity_item)) $content->activity_item = [];
        $data['content'] = $content;
        return view('backend.pages.about.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Pages::ABOUT_GENERAL_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $about = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();

        if(!empty($about)) $content = json_decode($about->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->$key;
        }

        $about_header_image = @$content->header_image;

        if ($request->hasFile('header_image')) {
            $header_image = $request->file('header_image');
            if(!empty($about_header_image) && Storage::disk('public')->exists($about_header_image)){
                Storage::disk('public')->delete($about_header_image);
            }
            $about_header_image = $header_image->store('about/general','public');
        }
        $content->header_image = $about_header_image;

        $about->content = json_encode($content);

        if($about->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function visionSave(Request $request)
    {
        $validate_rule = Pages::ABOUT_VISION_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $about = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();

        if(!empty($about)) $content = json_decode($about->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->$key;
        }

        $vision_image = @$content->vision_image;

        if ($request->hasFile('vision_image')) {
            $header_image_file = $request->file('vision_image');
            if(!empty($vision_image) && Storage::disk('public')->exists($vision_image)){
                Storage::disk('public')->delete($vision_image);
            }
            $vision_image = $header_image_file->store('about/vision','public');
        }
        $content->vision_image = $vision_image;

        $about->content = json_encode($content);

        if($about->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function valueSave (Request $request)
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

        $about = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();
        if(!empty($about)) $content = json_decode($about->content);
        $values = !empty($content->values) ? $content->values : [];

        $valueImage = 'about/value/default.png';

        if ($request->hasFile('image'.$request->id)) {
            $image = $request->file('image'.$request->id);
            $valueImage = $image->store('about/value','public');
        }

        if($request->id ==0){
            $values[] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'description' => $request->post('description'.$request->id),
                'image' => $valueImage,
            ];
        }else{
            $id = $request->id - 1;
            $valueImage = $values[$id]->image;
            if ($request->hasFile('image'.$request->id)) {
                $image = $request->file('image'.$request->id);
                if(!empty($valueImage) && file_exists('storage/'.$valueImage)){
                    unlink('storage/'.$valueImage);
                }
                $valueImage = $image->store('about/value','public');
            }

            $values[$id] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'description' => $request->post('description'.$request->id),
                'image' => $valueImage,
            ];
        }

        usort($values, function($a, $b) {
            if ($a->priority == $b->priority) {
                return 0;
            }
            return ($a->priority < $b->priority) ? -1 : 1;
        });

        $content->values = $values;
        $about->content = json_encode($content);

        if($about->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function valueDelete(Request $request){
        $about = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();

        if(!empty($about)) $content = json_decode($about->content);
        $request->id = $request->id - 1;
        $values = $content->values;
        if(!empty($values[$request->id]->image) && file_exists('storage/'.$values[$request->id]->image)){
            unlink('storage/'.$values[$request->id]->image);
        }
        array_splice($values, $request->id,1);

        $content->values = $values;
        $about->content = json_encode($content);

        if($about->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil dihapus'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal hapus, coba lagi'));
        }
    }

    public function areaSave(Request $request)
    {
        $validate_rule = Pages::ABOUT_AREA_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $page = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();

        if(!empty($page)) $content = json_decode($page->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->post($key);
        }

        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function activitySave(Request $request)
    {
        $validate_rule = Pages::ABOUT_ACTIVITY_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $page = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();

        if(!empty($page)) $content = json_decode($page->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->$key;
        }

        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function activityImageSave (Request $request)
    {
        $validate_rule = array();
        $validate_rule['title'.$request->id] = 'required';
        $validate_rule['priority'.$request->id] = 'required';
        $validate_rule['category'.$request->id] = 'required';
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

        $page = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();
        if(!empty($page)) $content = json_decode($page->content);
        $activities = !empty($content->activities) ? $content->activities : [];

        $activityImage = 'about/activity/default.png';

        if ($request->hasFile('image'.$request->id)) {
            $image_file = $request->file('image'.$request->id);
            $activityImage = $image_file->store('about/activity','public');
        }

        if($request->id ==0){
            $activities[] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'category' => $request->post('category'.$request->id),
                'image' => $activityImage,
            ];
        }else{
            $id = $request->id - 1;
            $activityImage = $activities[$id]->image;
            if ($request->hasFile('image'.$request->id)) {
                $image = $request->file('image'.$request->id);
                if(!empty($activityImage) && file_exists('storage/'.$activityImage)){
                    unlink('storage/'.$activityImage);
                }
                $activityImage = $image->store('about/activity','public');
            }

            $activities[$id] = (object)[
                'title' => $request->post('title'.$request->id),
                'priority' => $request->post('priority'.$request->id),
                'category' => $request->post('category'.$request->id),
                'image' => $activityImage,
            ];
        }

        usort($activities, function($a, $b) {
            if ($a->priority == $b->priority) {
                return 0;
            }
            return ($a->priority < $b->priority) ? -1 : 1;
        });

        $content->activities = $activities;
        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function activityImageDelete(Request $request){
        $page = Pages::where('types',Constant::PAGES_TYPES_ABOUT)->first();

        if(!empty($page)) $content = json_decode($page->content);
        $request->id = $request->id - 1;
        $activities = $content->activities;
        if(!empty($activities[$request->id]->image) && file_exists('storage/'.$activities[$request->id]->image)){
            unlink('storage/'.$activities[$request->id]->image);
        }
        array_splice($activities, $request->id,1);

        $content->activities = $activities;
        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil dihapus'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal hapus, coba lagi'));
        }
    }

}
