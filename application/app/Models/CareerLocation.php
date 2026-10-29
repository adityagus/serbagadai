<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerLocation extends Model
{
    public $timestamps = false;
    protected $table = 'career_location';

    protected $fillable = [
        'career_id',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class,'career_id');
    }
}
