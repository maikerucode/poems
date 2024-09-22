<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTest extends Model
{
    use HasFactory;

    public function questions() {
        return $this->belongsToMany(Question::class, 'temptestquestions', 'question_id', 'temptest_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'testcategories', 'temptest_id', 'category_id');
    }
}
