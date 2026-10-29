<?php
namespace App\Helpers;

use App\Models\Notification;
use App\User;
use App\Util\Constant;

class SelectHelper {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */

    public static function getUserByUsername($request){
        if(empty($request->username)) {
            return false;
        }

        return User::where('username',$request->username)->first();
    }

    public static function getUserList() {
        $users = User::where('role','!=', Constant::USER_ROLE_ADMIN)->get();
        $data = [];

        foreach ($users as $user){
            $data[$user->id] = $user->name;
        }

        return $data;
    }

    public static function getCommonStatus() {
        return Constant::COMMON_STATUS_LIST;
    }

    public static function getMemberTypes() {
        return Constant::MEMBER_TYPES_LIST;
    }

    public static function getNotification(){
        $notification = Notification::where('userId',0)
                        ->where('status',Constant::NOTIFICATION_STATUS_UNREAD)
                        ->orderBy('created_at','desc')
                        ->get();
        $data['list'] = $notification;
        $data['count'] = count($notification);

        return $data;

    }

    public static function getCategoryList(){
        $datas = Category::orderBy('name','asc')->get();

        $result = [];

        foreach ($datas as $data){
            $result[$data->id] = $data->name;
        }

        return $result;
    }

    public static function getUnitList(){
        $datas = Unit::orderBy('name','asc')->get();

        $result = [];

        foreach ($datas as $data){
            $result[$data->id] = $data->name;
        }

        return $result;
    }

    public static function getMachineList(){
        $datas = Machine::orderBy('name','asc')->get();

        $result = [];

        $result[''] = 'Pilih Mesin';

        foreach ($datas as $data){
            $result[$data->id] = $data->name;
        }

        return $result;
    }

    public static function getDesignerList() {
        $users = User::where('role', Constant::USER_ROLE_DESIGNER)->get();
        $data = [];

        foreach ($users as $user){
            $data[$user->id] = $user->name;
        }

        return $data;
    }

    public static function getSelectList($type){
        if($type == 'getUserList'){
            return self::getUserList();
        }else if($type == 'getCommonStatus'){
            return self::getCommonStatus();
        }else if($type == 'getMemberTypes'){
            return self::getMemberTypes();
        }else if($type == 'getCategoryList'){
            return self::getCategoryList();
        }else if($type == 'getUnitList'){
            return self::getUnitList();
        }else if($type == 'getMachineList'){
            return self::getMachineList();
        }else if($type == 'getNotification'){
            return self::getNotification();
        }else if($type == 'getDesignerList'){
            return self::getDesignerList();
        }
    }
}
