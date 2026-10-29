<?php

namespace App\Models;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'icon',
        'image',
        'position',
        'advantages',
        'terms',
        'pricing',
        'status',
        'call_action',
    ];

    const FORM_VALIDATION = [
        'title' => 'required',
        'short_description' => 'required',
        'description' => 'required',
        'position' => 'required',
        'icon' => 'required_if:id,0',
        'image' => 'required_if:id,0',
        'advantages' => 'required',
        'terms' => 'required',
        'pricing' => 'required',
        'status' => 'required',
        'call_action' => 'required',
    ];

    const exportData = [
        'title'=>'Nama',
        'slug'=>'Slug',
        'short_description'=>'Deskripsi',
        'status'=>'Status',
        'created_at'=>'Created',
        'updated_at'=>'Updated',
    ];

    public function scopeActive($query) {
        return $query->where('status',Constant::COMMON_STATUS_ACTIVE);
    }
}
