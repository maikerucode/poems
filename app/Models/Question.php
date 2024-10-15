<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'correct_ans',
        'ques_body',
        'category_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class)->as('category');
    }

    public function correct_ans() {
        return $this->correct_ans;
    }

    public function ques_body() {
        return $this->ques_body;
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

}
