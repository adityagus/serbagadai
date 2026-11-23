<?php

namespace App\Models;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use SoftDeletes;
    protected $table = 'outlets';

    protected $fillable = [
        'name',
        'province_id',
        'address',
        'lat_lng',
        'open_hour',
        'close_hour',
        'days',
        'operational_hours',
        'status',
    ];

    const FORM_VALIDATION = [
        'name' => 'required',
        'province_id' => 'required',
        'address' => 'required',
        'lat_lng' => 'required',
        'open_hour' => 'nullable|string|max:20',
        'close_hour' => 'nullable|string|max:20',
        'days' => 'nullable|string|max:50',
        'operational_hours' => 'nullable|string|max:200',
        'status' => 'required',
    ];

    const exportData = [
        'name'=>'Nama',
        'province_id'=>'Province Id',
        'province_name'=>'Province',
        'address'=>'Alamat',
        'lat_lng'=>'Lat/Lng',
        'days'=>'Hari Operasional',
        'open_hour'=>'Jam Buka',
        'close_hour'=>'Jam Tutup',
        'operational_hours'=>'Jam Operasional',
        'status'=>'Status',
        'created_at'=>'Created',
        'updated_at'=>'Updated',
    ];

    public function getProvinceNameAttribute(){
        return @$this->province->name;
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }

    public function scopeActive($query) {
        return $query->where('status',Constant::COMMON_STATUS_ACTIVE);
    }
}
