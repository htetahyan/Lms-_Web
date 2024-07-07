<?php

namespace App\Models;

use App\Models\EntranceTest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrance_test_id','total_score','reference_number','participant_id'
    ];

    public function entranceTest()
    {
        return $this->belongsTo(EntranceTest::class);
    }
}

