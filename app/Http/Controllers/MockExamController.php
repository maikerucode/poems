<?php

namespace App\Http\Controllers;

use App\Models\FinalTest;
use App\Models\TempTest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Question;

class MockExamController extends Controller
{
    public function home() {

        $categories = DB::table('categories')
        ->get();

        $exam_date = Carbon::parse('2024-11-23');
        $date_now = Carbon::now();
        $date_string = $date_now->format('F d, Y');
        $days_remaining = $exam_date->diffInDays($date_now);
        $days_remain = intval($days_remaining * -1);

        return view('roadtorslp.examhome',
        [
            'categories' => $categories,
            'remaining_days' => $days_remain,
            'curr_date' => $date_string,
        ]
        );
    }

    public function singleQues() {
        $question = Question::with('answers')
        // ->distinct()
        ->first();

        // dd($question);

        return view('roadtorslp.questionPage',
            [
                'question' => $question
            ]);
    }

    public function makeTempTest(Request $request) {

        $categories = $request->input('categories');
        $time_limit = $request->input('time_limit');
        $num_of_ques = $request->input('ques_num');
        dd($categories, $time_limit, $num_of_ques);

        // $temptest = TempTest::create([
        //     'category_id'
        // ]);



    }

    public function makeFinalTest(Request $request) {

        $finaltest = FinalTest::create([
            'temptest_id' => $request->input('temptest_id'),
            'status' => 'pending',
            'is_graded' => false,
            'score' => 0
        ]);
        
        return $finaltest;
    }
}