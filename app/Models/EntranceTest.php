<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntranceTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_name','allowed_time','exam_type','exam_code','description','total_questions_count'
    ];

    public function testResults()
    {
        return $this->hasMany(TestResult::class,'entrance_test_id');
    }
}
