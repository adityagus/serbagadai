<?php

namespace App\Models;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use SoftDeletes;
    protected $table = 'promos';

    protected $fillable = [
        'title',
        'image',
        'valid_date',
        'action_link',
        'status',
    ];

    const FORM_VALIDATION = [
        'title' => 'required',
        'valid_date' => 'required|date',
        'action_link' => 'nullable',
        'status' => 'required',
        'image' => 'required_if:id,0',
    ];

    const exportData = [
        'title'=>'Judul',
        'valid_date'=>'Tanggal Valid',
        'action_link'=>'Link',
        'status'=>'status',
        'image'=>'Gambar',
        'created_at'=>'Created',
        'updated_at'=>'Updated',
    ];

    public function scopeActive($query) {
        return $query->where('status',Constant::COMMON_STATUS_ACTIVE);
    }
}
