<?php

namespace App\Models;

use App\Models\EntranceTest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrance_test_id','question_text','answer_list','correct_answer'
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'answer_list' => 'array',
    ];

    public function entranceTest()
    {
        return $this->belongsTo(EntranceTest::class);
    }
}
