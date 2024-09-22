<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockExamController extends Controller
{
    public function home() {
        return view('roadtorslp.examhome');
    }
}
