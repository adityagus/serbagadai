<?php
namespace App\Services;

class CommonService {
    public static function createSlug($title){

        $title = str_replace(' ', '-', $title); // Replaces all spaces with hyphens.
        $title = preg_replace('/[^A-Za-z0-9\-]/', '', $title); // Removes special chars.

        return strtolower($title);
    }
}
