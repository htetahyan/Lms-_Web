<?php

namespace App\Models;

use App\Models\User;
use App\Models\Year;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name','last_name','student_code','class_id','dob','mother_name','father_name','email','phone','enrollment_date','student_image_url','gender','address','class',
        'section','password','type','month','time','year_id','student_image_uri'
    ];

    public function parent()
    {
        return $this->belongsTo(User::class,'students.parent_code','users.parent_code');
    }


    public function year()
    {
        return $this->belongsTo(Year::class);
    }

}
