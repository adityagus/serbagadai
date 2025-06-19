<?php
namespace App\Helpers;

class FileHelper {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */

    public static function uploadFile($request, $key, $currentFile, $path){

        $file = $request->file($key);
        if(!empty($currentFile) && file_exists('storage/'.$currentFile)){
            unlink('storage/'.$currentFile);
        }
        $result = $file->store('../'.$path.'/'.$request->$key,'public');

        return $result;
    }
}
