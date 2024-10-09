<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_text',
        'question_id',
    ];

    public function getQuestion() {
        return $this->belongsTo(Question::class, 'question_id', 'id', 'questions');
    }
}
