<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerSubmission extends Model
{
    protected $table = 'career_submissions';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cover_letter',
        'career_id',
        'cv',
    ];

    const FORM_VALIDATION = [
        'name' => 'required',
        'email' => 'email|required',
        'phone' => 'required',
        'cover_letter' => 'required',
        'cv' => 'required|max:2048|mimes:jpeg,jpg,png,JPG,JPEG,PNG,pdf,PDF',
    ];

    const exportData = [
        'name'=>'Nama',
        'email'=>'Email',
        'phone'=>'Phone',
        'career_name'=>'Karir',
        'cover_letter'=>'Cover Letter',
        'created_at'=>'Created',
    ];

    public function getCareerNameAttribute(){
        return !empty($this->career->title) ? $this->career->title : 'Drop CV';
    }

    public function career(){
        return $this->belongsTo(Career::class,'career_id');
    }
}
