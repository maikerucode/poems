<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalTest extends Model
{
    use HasFactory;

    public function getTempTest() {
        return $this->belongsTo(TempTest::class, 'temptest_id', 'id', 'temptests');
    }
}
