<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Outlet;
use App\Models\Province;
use App\Util\Constant;
use Illuminate\Http\Request;
use DataTables;

class OutletController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $data['outlets'] = Outlet::with('province')->active()->get();
        $data['provinces'] = Province::where('outlet_count','>','0')->orderBy('outlet_count','desc')->get();
        return view('frontend.pages.outlet',$data);
    }

    public function indexData(Request $request){
        $datas = Outlet::orderBy('province_id','asc');
        $datas->with(['province']);

        $filter = [
            'search'    => 'search',
            'outlets.province_id'   => '=',
        ];

        if(!empty($request->get('outlets.name'))){
            $request['outlets.address'] = $request->get('outlets.name');
        }

        foreach ($filter as $key => $operator) {
            $key_attributes = $key;
            $key = str_replace('.','_',$key);
            if (!empty($request->$key)) {
                if ($operator == 'search') {
                    $search = $request->$key;
                    $datas->where(function ($query) use ($search){
                        $query->where('outlets.name','ilike','%' . $search . '%');
                        $query->orWhere('outlets.address','ilike','%' . $search . '%');
                    });
                } else {
                    $datas->where($key_attributes, $operator, $request->$key);
                }
            }
        }
        return DataTables::of($datas->get())
            ->editColumn('status',function($data) {
                return '<label class="label label-'.Constant::COMMON_STATUS_LABEL_LIST[$data->status].'">'.Constant::COMMON_STATUS_LIST[$data->status].'</label>';
            })
            ->editColumn('province_id',function($data){
                return '<span class="caption-14 grayscale-700">'.@$data->province->name.'</span>';
            })
            ->editColumn('name',function($data){
                return '<span class="caption-14 grayscale-700">'.@$data->name.'</span>';
            })
            ->editColumn('address',function($data){
                return '<span class="caption-14 grayscale-700">'.@$data->address.'</span>';
            })
            ->editColumn('created_at',function($data){
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at',function($data){
                return $data->updated_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action',function($data) {
                return '<a onclick="editData('.$data->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->escapeColumns([])->make(true);
    }
}



