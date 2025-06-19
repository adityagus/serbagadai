<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;
    protected $table = 'province';
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'image',
    ];

    const FORM_VALIDATION = [
        'id' => 'required',
        'name' => 'required',
        'image' => 'required_if:id,0',
    ];

    const exportData = [
        'id'=>'ID',
        'name'=>'Nama',
        'image'=>'Gambar',
        'outlet_count'=>'Jumlah Outlet',
    ];
}
