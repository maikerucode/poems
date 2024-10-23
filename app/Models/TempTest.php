<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTest extends Model
{
    use HasFactory;

    protected $table = 'temptests';

    protected $fillable = [
        'id',
        'title'
    ];

    public function questions() {
        return $this->belongsToMany(Question::class, 'temptestquestions', 'temptest_id', 'question_id')->withPivot('ques_order');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'testcategories', 'temptest_id', 'category_id')->as('categories');
    }
}
