<?php

namespace App\Models;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'featured_image',
        'banner_image',
        'content',
        'status',
    ];

    const FORM_VALIDATION = [
        'title' => 'required',
        'content' => 'required',
        'status' => 'required',
        'featured_image' => 'required_if:id,0',
        'banner_image' => 'required_if:id,0',
    ];

    const exportData = [
        'title'=>'Nama',
        'slug_link'=>'Slug',
        'status'=>'Status',
        'created_at'=>'Created',
        'updated_at'=>'Updated',
    ];

    public function getSlugLinkAttribute(){
        return $this->slug;
    }

    public function scopeActive($query) {
        return $query->where('status',Constant::COMMON_STATUS_ACTIVE);
    }
}
