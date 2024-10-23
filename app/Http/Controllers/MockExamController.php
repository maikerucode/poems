<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        ->orderBy('category_name', 'asc')
        ->get();

        $exam_date = Carbon::parse('2024-11-23');
        $date_now = Carbon::now();
        $date_string = $date_now->format('F d, Y');
        $days_remaining = $exam_date->diffInDays($date_now);
        $days_remain = intval($days_remaining * -1);

        $final_tests = FinalTest::with('temptest')
            ->orderBy('created_at','desc')
            ->get();

        return view('roadtorslp.examhome',
        [
            'categories' => $categories,
            'remaining_days' => $days_remain,
            'curr_date' => $date_string,
            'final_tests' => $final_tests
            ]
        );
    }

    public function singleQues($id) {
        $finaltest = FinalTest::with('temptest.questions')->find($id);
        
        $date_now = Carbon::now();
        if ($date_now > $finaltest->end_time || $finaltest->is_graded) {
            return redirect()->route('exam.testEnd', $finaltest->id);
        }
        
        $currentQuesID = $finaltest->current_ques;
        $temptest_id = $finaltest->temptest_id;

        $questions = $finaltest->temptest->questions()
        ->where('temptest_id', $temptest_id)
        ->orderBy('ques_order')
        ->get();

        $question_count = $finaltest->temptest->questions()->count();
        
        $currentQuestion = $questions[$currentQuesID];


        return view('roadtorslp.questionPage',
            [
                'question_count'=> $question_count,
                'finaltest' => $finaltest,
                'question' => $currentQuestion,
                'end_time' => $finaltest->end_time,
            ]);
    }

    public function nextQues(Request $request) {
        $isCorrect = $request->input('isCorrect');
        $finaltest_id = $request->input('finaltest_id');
        $finaltest = FinalTest::with('temptest.questions')->find($finaltest_id);

        $date_now = Carbon::now();
        if ($date_now > $finaltest->end_time) {
            return redirect()->route('exam.testEnd', $finaltest->id);
        }

        $question_count = $finaltest->temptest->questions()->count();
        
        if ($isCorrect == 'true') {
            $finaltest->score = $finaltest->score + 1;
        }
        
        if ($finaltest->current_ques < ($question_count - 1)) {
            $finaltest->current_ques = $finaltest->current_ques + 1;
        } else {
            $finaltest->is_graded = true;
            $finaltest->save();
            return redirect()->route('exam.testEnd', $finaltest->id);
        }
        
        $finaltest->save();
        return redirect()->route('exam.sampleQues', $finaltest_id);
    }

    public function makeTempTest(Request $request) {

        $time_limit = $request->input('time_limit');
        $selectedCategories = $request->input('categories');
        $n = $request->input('ques_num');

        $carbon_hourStr = null;

        if ($time_limit == "2:00:00") {
            $carbon_hourStr = Carbon::now()->addHours(2)->toDateTimeString();
        } else if ($time_limit == "1:30:00") {
            $carbon_hourStr = Carbon::now()->addHours(1)->addMinutes(30)->toDateTimeString();
        } else if ($time_limit == "1:00:00") {
            $carbon_hourStr = Carbon::now()->addHours(1)->toDateTimeString();
        } else {
            $carbon_hourStr = Carbon::now()->addHours(96)->toDateTimeString();
        }

        $questionsPerCategory = (int) floor($n / count($selectedCategories));

        $finalQuestions = collect();

        $category_names = [];

        foreach ($selectedCategories as $category_id) {
            $questions = Question::with('answers')
                ->where('category_id', $category_id)
                ->inRandomOrder()
                ->limit($questionsPerCategory)
                ->get();
            
            $category_names[] = Category::find($category_id)->category_name;
            $finalQuestions = $finalQuestions->merge($questions);
        }
        
        if ($finalQuestions->count() < $n) {
            $questions = Question::with('answers')
            ->where('category_id', $selectedCategories[0])
            ->inRandomOrder()
            ->limit($n - $finalQuestions->count())
            ->get();
            
            $finalQuestions = $finalQuestions->merge($questions);
        }

        $shuffledQuestions = $finalQuestions->shuffle();

        $custom_temptest = TempTest::create([
            'title' => 'Test ' . Carbon::now()->format('Y-m-d H:i:s')
        ]);

        foreach ($shuffledQuestions as $index => $question) {
            $custom_temptest->questions()->attach($question->id, ['ques_order' => $index]);
        }

        foreach ($selectedCategories as $category_id) {
            $custom_temptest->categories()->attach($category_id);
        }

        $finaltest = FinalTest::create([
            'temptest_id' => $custom_temptest->id,
            'status' => 'pending',
            'is_graded' => false,
            'end_time' => $carbon_hourStr,
            'score' => 0,
            'current_ques' => 0,
        ]);

        return redirect()->back();
    }

    public function remakeTempTest($id) {
        $finaltest = FinalTest::find($id);
        $temptest = TempTest::find($finaltest->temptest_id);
    }

    public function testEnd($id) {
        $finaltest = FinalTest::find($id);
        $question_count = $finaltest->temptest->questions()->count();
        $score = $finaltest->score;
        $percentage = $score / $question_count;

        return view('roadtorslp.testEnd',
            [
                'finaltest' => $finaltest,
                'finish_time' => $finaltest->updated_at,
                'end_time' => $finaltest->end_time,
                'total_items' => $question_count,
                'score' => $score,
                'percentage'=> number_format($percentage * 100, 2) . '%'
            ]);
    }

    public function checkQues($id) {
        $question = Question::where('id','=', $id)->first();
        $category = Category::where('id', $question->category_id)->first();
        return view('roadtorslp.sampleQues',
        [
            'question' => $question,
            'ques_category' => $category,
        ]);
    }

    public function retryTest($id, Request $request) {
        $finaltest = FinalTest::find($id);
        $questions = $finaltest->temptest->questions()->get();
        $categories = $finaltest->temptest->categories()->get();
        $attemptCount = FinalTest::where('temptest_id','=', $finaltest->temptest_id)->count();

        $shuffledQuestions = $questions->shuffle();
        $time_limit = $request->input('time_limit');

        if ($time_limit == "2:00:00") {
            $carbon_hourStr = Carbon::now()->addHours(2)->toDateTimeString();
        } else if ($time_limit == "1:30:00") {
            $carbon_hourStr = Carbon::now()->addHours(1)->addMinutes(30)->toDateTimeString();
        } else if ($time_limit == "1:00:00") {
            $carbon_hourStr = Carbon::now()->addHours(1)->toDateTimeString();
        } else {
            $carbon_hourStr = Carbon::now()->addHours(96)->toDateTimeString();
        }

        $custom_temptest = TempTest::create([
            'title' => 'Retry Test A#' . ($attemptCount + 1) . " " . $finaltest->updated_at
        ]);

        foreach ($shuffledQuestions as $index => $question) {
            $custom_temptest->questions()->attach($question->id, ['ques_order' => $index]);
        }

        foreach ($categories as $category_id) {
            $custom_temptest->categories()->attach($category_id);
        }

        $finaltest = FinalTest::create([
            'temptest_id' => $custom_temptest->id,
            'status' => 'pending',
            'is_graded' => false,
            'end_time' => $carbon_hourStr,
            'score' => 0,
            'current_ques' => 0,
        ]);

        return redirect()->route('exam.home');
    }
}