<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalTest extends Model
{
    use HasFactory;

    protected $table = 'finaltests';

    protected $fillable = [
        'temptest_id',
        'status',
        'is_graded',
        'score',
        'end_time',
        'current_ques'
    ];

    public function temptest() {
        return $this->belongsTo(TempTest::class, 'temptest_id', 'id');
    }
}
