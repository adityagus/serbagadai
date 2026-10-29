<?php

namespace App\Http\Controllers\BackEnd;
use App\Advertise;

use App\Appliance;
use App\Notification;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Response;

class NotificationController extends BackEndController
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
        $data['sidebar'] = 'notification';
        return view('backend.notification.index',$data);
    }

    public function getData($id){
        return Response::json(Notification::find($id));
    }

    public function indexData(Request $request){
        $notifications = Notification::orderBy('created_at','desc')->where('userId',0)->get();

        return DataTables::of($notifications)
            ->addColumn('aksi',function($notification) {
                return '<a onclick="editData('.$notification->id.')" class="btn btn-info btn-xs">Detail</a>';
            })
            ->filter(function ($instance) use ($request) {
                if ($request->has('subject') && !empty($request->subject) ) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['subject'], $request->get('subject')) ? true : false;
                    });
                }

                if ($request->has('description') && !empty($request->description)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['description'], $request->get('description')) ? true : false;
                    });
                }

                if ($request->has('type') && !empty($request->type)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['type'], $request->get('type')) ? true : false;
                    });
                }

                if ($request->has('status') && !empty($request->status)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['status'], $request->get('status')) ? true : false;
                    });
                }
            })
            ->escapeColumns([])->make(true);
    }

    public function clear(){
        return Notification::where('userId',0)
                ->where('status',Constant::NOTIFICATION_STATUS_UNREAD)
                ->update(['status'=>Constant::NOTIFICATION_STATUS_READ]);
    }
}
