<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'types',
        'content',
    ];

    const HOME_HERO_VALIDATION = [
        'hero_header' => 'required',
        'hero_sub_header' => 'required',
        'hero_action' => 'nullable',
    ];

    const HOME_ABOUT_VALIDATION = [
        'about_title' => 'required',
        'about_content' => 'required',
    ];

    const HOME_PRODUCT_VALIDATION = [
        'product_title' => 'required',
        'product_sub_title' => 'required',
        'product_menu_title' => 'required',
        'product_menu_content' => 'required',
    ];

    const HOME_TESTIMONY_VALIDATION = [
        'testimony_header' => 'required',
        'testimony_sub_header' => 'required',
        'testimony_action' => 'nullable',
    ];

    const ABOUT_GENERAL_VALIDATION = [
        'general_title' => 'required',
        'general_sub_header' => 'required',
        'general_content' => 'required',
    ];

    const ABOUT_VISION_VALIDATION = [
        'vision_content' => 'required',
        'mission_content' => 'required',
    ];

    const ABOUT_AREA_VALIDATION = [
        'area_title' => 'required',
        'area_content' => 'required',
    ];

    const ABOUT_ACTIVITY_VALIDATION = [
        'activity_header' => 'required',
        'activity_sub_header' => 'required',
    ];

    const ABOUT_ACTIVITY_ITEM_CATEGORY = [
        'MARKETING' => 'Marketing',
        'INTERNAL' => 'Internal',
        'CSR' => 'Social Corporate Responsibility',
    ];

    const CAREER_GENERAL_VALIDATION = [
        'general_title' => 'required',
        'general_testimony' => 'required',
        'general_drop_cv' => 'required',
    ];

    const PRODUCT_GENERAL_VALIDATION = [
        'menu_title' => 'required',
        'menu_short_description' => 'required',
    ];

}
