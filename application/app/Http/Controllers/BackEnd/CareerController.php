<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\DataExport;
use App\Models\Career;
use App\Models\CareerLocation;
use App\Models\CareerSubmission;
use App\Models\Config;
use App\Models\Location;
use App\Models\Pages;
use App\Services\CommonService;
use App\Util\Constant;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Validator;
use Response;
use Input;
use Excel;

class CareerController extends BackEndController
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
        $data['sidebar'] = 'career';
        $data['locations'] = Location::get();
        return view('backend.career.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Career::FORM_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = Career::find($request->id);

        if(empty($data->id)){
            $data = new Career();
        }

        $data->fill((array)$request->all());
        $data->slug = CommonService::createSlug($request->title);

        if($data->save()){

            if(!empty($request->locations)){
                $locations = [];
                foreach (json_decode($request->locations) as $item) $locations[] = $item->location;
                $data->location()->sync($locations);
            }

            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan','data'=>$data->id));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }

    }

    public function detail($id){
        $data['sidebar'] = 'career';
        $data['model'] = !empty($id) ? Career::find($id) : Career::class;
        $data['career_location'] = CareerLocation::where('career_id',$id)->get();
        $data['locations'] = Location::get();
        return view('backend.career.detail',$data);
    }

    public function indexData(Request $request){
        $datas = Career::orderBy('updated_at','desc');
        $datas->with(['location']);

        $filter = [
            'careers.title'    => 'like',
            'careers.category'    => '=',
            'careers.types'    => '=',
            'careers.status'   => '=',
        ];

        foreach ($filter as $key => $operator) {
            $key_attributes = $key;
            $key = str_replace('.','_',$key);
            if (!empty($request->$key)) {
                if ($operator == 'like') {
                    $datas->where($key_attributes, $operator, '%' . $request->$key . '%');
                } else {
                    $datas->where($key_attributes, $operator, $request->$key);
                }
            }
        }

        if($request->has('location') && !empty($request->location)){
            $location = $request->location;
            $datas->whereHas('location',function ($query) use ($location){
                $query->where('location_id',$location);
            });
        }

        return DataTables::of($datas->get())
            ->editColumn('status',function($data) {
                return '<label class="label label-'.Constant::COMMON_STATUS_LABEL_LIST[$data->status].'">'.Constant::COMMON_STATUS_LIST[$data->status].'</label>';
            })
            ->editColumn('category',function($data){
                return Constant::CAREER_CATEGORY_LIST[$data->category];
            })
            ->editColumn('types',function($data){
                return Constant::CAREER_TYPES_LIST[$data->types];
            })
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at',function($data){
                return $data->updated_at->format('Y-m-d H:i:s');
            })
            ->addColumn('locations',function($data) {
                $locations = [];
                foreach ($data->location as $location) $locations[] = $location->name;
                return implode(', ',$locations);
            })
            ->addColumn('action',function($data) {
                return '<a href="'.route('admin.career.detail',['id'=>$data->id]).'"class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $data = Career::find($id);

        if(!empty($data->icon) && Storage::disk('public')->exists($data->icon)){
            Storage::disk('public')->delete($data->icon);
        }

        if(!empty($data->image) && Storage::disk('public')->exists($data->image)){
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();
    }

    public function export()
    {
        $datas = Career::get();

        $result = [];

        foreach ($datas as $data){
            $result[] =[
                'title'=>$data->title,
                'slug'=>$data->slug,
                'short_description'=>$data->short_description,
                'status'=>Constant::COMMON_STATUS_LIST[$data->status],
                'created_at'=> $data->created_at,
                'updated_at'=> $data->updated_at,
            ];
        }

        $data['data'] = [
            'model'=>Career::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Career',
            'description'=> 'Data career',
        ];

        return Excel::download(new DataExport($data), 'export_career_'.time().'.xlsx');
    }

    public function setting()
    {
        $data['sidebar'] = 'setting-career';
        $data['config'] = Config::find(1);
        $page = Pages::where('types',Constant::PAGES_TYPES_CAREER)->first();
        $content = new \stdClass();
        if(!empty($page)) $content = json_decode($page->content);
        if(empty($content->testimony_item)) $content->testimony_item = [];
        $data['content'] = $content;
        return view('backend.pages.career.index',$data);
    }

    public function settingSave(Request $request)
    {
        $validate_rule = Pages::CAREER_GENERAL_VALIDATION;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $page = Pages::where('types',Constant::PAGES_TYPES_CAREER)->first();

        if(!empty($page)) $content = json_decode($page->content);

        foreach ($validate_rule as $key => $value){
            $content->$key = $request->$key;
        }

        $career_header_image = @$content->header_image;

        if ($request->hasFile('header_image')) {
            $header_image = $request->file('header_image');
            if(!empty($career_header_image) && Storage::disk('public')->exists($career_header_image)){
                Storage::disk('public')->delete($career_header_image);
            }
            $career_header_image = $header_image->store('career/general','public');
        }
        $content->header_image = $career_header_image;

        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function testimonyItemSave (Request $request)
    {
        $validate_rule = array();
        $validate_rule['name'.$request->id] = 'required';
        $validate_rule['role'.$request->id] = 'required';
        $validate_rule['quote'.$request->id] = 'required';
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

        $page = Pages::where('types',Constant::PAGES_TYPES_CAREER)->first();
        if(!empty($page)) $content = json_decode($page->content);
        $testimony_item = !empty($content->testimony_item) ? $content->testimony_item : [];

        $testimonyImage = 'career/testimony/default.png';

        if ($request->hasFile('image'.$request->id)) {
            $image = $request->file('image'.$request->id);
            $testimonyImage = $image->store('career/testimony','public');
        }

        if($request->id ==0){
            $testimony_item[] = (object)[
                'name' => $request->post('name'.$request->id),
                'role' => $request->post('role'.$request->id),
                'quote' => $request->post('quote'.$request->id),
                'description' => $request->post('description'.$request->id),
                'image' => $testimonyImage,
            ];
        }else{
            $id = $request->id - 1;
            $testimonyImage = $testimony_item[$id]->image;
            if ($request->hasFile('image'.$request->id)) {
                $image = $request->file('image'.$request->id);
                if(!empty($testimonyImage) && file_exists('storage/'.$testimonyImage)){
                    unlink('storage/'.$testimonyImage);
                }
                $testimonyImage = $image->store('career/testimony','public');
            }

            $testimony_item[$id] = (object)[
                'name' => $request->post('name'.$request->id),
                'role' => $request->post('role'.$request->id),
                'quote' => $request->post('quote'.$request->id),
                'description' => $request->post('description'.$request->id),
                'image' => $testimonyImage,
            ];
        }

        $content->testimony_item = $testimony_item;
        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }

    public function testimonyItemDelete(Request $request){
        $page = Pages::where('types',Constant::PAGES_TYPES_CAREER)->first();

        if(!empty($page)) $content = json_decode($page->content);
        $request->id = $request->id - 1;
        $testimony_item = $content->testimony_item;
        if(!empty($testimony_item[$request->id]->image) && file_exists('storage/'.$testimony_item[$request->id]->image)){
            unlink('storage/'.$testimony_item[$request->id]->image);
        }
        array_splice($testimony_item, $request->id,1);

        $content->testimony_item = $testimony_item;
        $page->content = json_encode($content);

        if($page->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil dihapus'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal hapus, coba lagi'));
        }
    }

    public function indexSubmission()
    {
        $data['sidebar'] = 'career-submission';
        $data['careers'] = Career::get();
        return view('backend.career.submission',$data);
    }

    public function indexDataSubmission(Request $request){
        $datas = CareerSubmission::orderBy('created_at','desc');
        $datas->with(['career']);

        $filter = [
            'career_submissions.name'    => 'like',
            'career_submissions.email'   => 'like',
            'career_submissions.phone'   => 'like',
            'career_submissions.career_id'   => '=',
        ];

        foreach ($filter as $key => $operator) {
            $key_attributes = $key;
            $key = str_replace('.','_',$key);
            if (!empty($request->$key)) {
                if ($operator == 'like') {
                    $datas->where($key_attributes, $operator, '%' . $request->$key . '%');
                } else {
                    $datas->where($key_attributes, $operator, $request->$key);
                }
            }
        }

        return DataTables::of($datas->get())
            ->editColumn('cv',function($data){
                return '<a target="_blank" class="alert-success" href="'.url('storage/'.$data->cv).'"> Lihat File </a>';
            })
            ->editColumn('career_id',function($data){
                return !empty($data->career) ? @$data->career->title : 'Drop CV';
            })
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at',function($data){
                return $data->updated_at->format('Y-m-d H:i:s');
            })
            ->escapeColumns([])->make(true);
    }

    public function exportSubmission()
    {
        $datas = CareerSubmission::get();

        $result = [];

        foreach ($datas as $data){
            $result[] = (object)[
                'name'=>$data->name,
                'email'=>$data->email,
                'phone'=>$data->phone,
                'cover_letter'=>$data->cover_letter,
                'created_at'=> $data->created_at,
                'updated_at'=> $data->updated_at,
            ];
        }

        $data['data'] = [
            'model'=>CareerSubmission::class,
            'items'=>$datas
        ];

        $data['properties'] =[
            'title'=> 'Export Data Career Submission',
            'description'=> 'Data Career Submission',
        ];

        return Excel::download(new DataExport($data), 'export_career_submission_'.time().'.xlsx');
    }

}
