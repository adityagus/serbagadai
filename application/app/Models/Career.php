<?php

namespace App\Models;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;
    protected $table = 'careers';

    protected $fillable = [
        'title',
        'short_description',
        'slug',
        'category',
        'types',
        'qualification',
        'job_desk',
        'status',
    ];

    const FORM_VALIDATION = [
        'title' => 'required',
        'short_description' => 'required',
        'category' => 'required',
        'types' => 'required',
        'qualification' => 'required',
        'job_desk' => 'required',
        'status' => 'required',
        'locations' => 'required_if:id,0',
    ];

    const exportData = [
        'title'=>'Nama',
        'short_description'=>'Deskripsi Singkat',
        'slug'=>'Slug',
        'category_name'=>'Kategori',
        'types_name'=>'Type',
        'location_name'=>'Location',
        'status'=>'Status',
        'created_at'=>'Created',
        'updated_at'=>'Updated',
    ];

    public function getCategoryNameAttribute(){
        return Constant::CAREER_CATEGORY_LIST[$this->category];
    }

    public function getTypesNameAttribute(){
        return Constant::CAREER_TYPES_LIST[$this->types];
    }

    public function getLocationNameAttribute(){
        $locations = [];
        foreach ($this->location as $location) $locations[] = $location->name;
        return implode(', ',$locations);
    }

    public function location()
    {
        return $this->belongsToMany(Location::class,'career_location','career_id','location_id');
    }

    public function scopeActive($query) {
        return $query->where('status',Constant::COMMON_STATUS_ACTIVE);
    }
}
