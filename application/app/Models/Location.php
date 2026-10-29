<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;
    protected $table = 'locations';

    protected $fillable = [
        'name',
    ];

    const FORM_VALIDATION = [
        'name' => 'required',
    ];

    const exportData = [
        'id'=>'ID',
        'name'=>'Nama',
    ];

    public function career()
    {
        return $this->belongsToMany(Career::class);
    }
}
