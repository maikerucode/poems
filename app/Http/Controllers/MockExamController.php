<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MockExamController extends Controller
{
    public function home() {

        $categories = DB::table('categories')
        ->get();

        $exam_date = Carbon::parse('2024-11-23');
        $date_now = Carbon::now();
        $days_remaining = $exam_date->diffInDays($date_now);
        $days_remain = intval($days_remaining * -1);

        return view('roadtorslp.examhome',
        [
            'categories' => $categories,
            'remaining_days' => $days_remain,
        ]
        );
    }
}
