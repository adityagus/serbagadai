<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'content',
    ];

    const exportData = [
        'name'=>'Nama',
        'email'=>'Email',
        'phone'=>'Phone',
        'content'=>'Konten',
        'created_at'=>'Created',
    ];

    const CONTACT_VALIDATION = [
        'name' => 'required',
        'email' => 'email|required',
        'phone' => 'required',
        'content' => 'required',
    ];
}
