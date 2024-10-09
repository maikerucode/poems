<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FinalTest;
use App\Models\TempTest;
use DB;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;

class PDFExtractController extends Controller
{
    public function parseQuestions(Request $request): array
{
    $questions = [];
    $currentQuestion = null;
    $isQuestionBody = false;

    $category_id = $request->input('category');
    $file = $request->file('examFile');
    $filePath = public_path($file->move('pdf', $file->getClientOriginalName()));
    $lines = file($filePath);

    for ($index = 0; $index < count($lines); $index++) {
        $line = $lines[$index];

        if (preg_match('/^\d+\./', $line)) {
            // If there's a current question, store it before starting a new one
            if ($currentQuestion != null && !$isQuestionBody) {
                $questions[] = $currentQuestion;
            }

            // Initialize the current question
            $newLine = preg_replace('/^\d+\./', '', $line);
            $currentQuestion = [
                'question' => trim($newLine),
                'answers' => [],
            ];

            // Check for subsequent lines that also match the question pattern
            for ($i = $index + 1; $i < count($lines); $i++) {
                if (preg_match('/^\d+\./', $lines[$i])) {
                    $newLineAppend = preg_replace('/^\d+\./', '', $lines[$i]);
                    $currentQuestion['question'] .= ' | ' . trim($newLineAppend);
                    $index = $i;
                } else {
                    break;
                }
            }
        } elseif (preg_match('/^\s*\d+\.\s.*$/', $line)) {
            // If the line is an answer, add it to the current question
            if ($currentQuestion) {
                $newLineAnswer = preg_replace('/^\d+\./', ' ', trim($line));
                $currentQuestion['answers'][] = trim($newLineAnswer);
            }
        }
    }

    // Store the last question if it's not empty
    if ($currentQuestion && !empty($currentQuestion['question'])) {
        $questions[] = $currentQuestion;
    }

    File::delete($filePath);
    // dd($questions);
    $this->importQuestions($questions, $category_id);
    return $questions;
}
public function home() {
    
    return view('roadtorslp.pdfextract', [
        'categories' => Category::all(),
        ]
    );
}

public function importQuestions($questions, $category_id) {
    
    $category = Category::where('id', $category_id)->first();
    $temptest = TempTest::create(['title' => $category->category_name . ' Template Exam']); 
    $temptest->categories()->attach($category_id);
        
        foreach ($questions as $question) {
            $data = [
                'ques_body' => $question['question'],
                'category_id' => $category->id,
            ];

            $validatedData = Validator::make($data, [
                'ques_body' => 'required|string',
                'category_id' => 'required|integer',
            ]);

            if ($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            } else {
                $new_ques = Question::create($validatedData->validated());
                $answers = $question['answers'];
                
                foreach ($answers as $answer) {
                    $newAnswer = Answer::create([
                        'answer_text' => $answer, 
                        'question_id' => $new_ques->id
                    ]);
                }
                $temptest->questions()->attach($new_ques->id);

            }
        }
        $questionSample = DB::table('questions')
            ->leftjoin('categories', 'questions.category_id', '=', 'categories.id')
            ->leftjoin('answers', 'questions.id', '=', 'answers.question_id')
            ->leftjoin('temptestquestions', 'questions.id', '=', 'temptestquestions.question_id')
            ->leftjoin('temptests', 'temptestquestions.temptest_id', '=', 'temptests.id')
            ->select('categories.category_name', 'temptests.title', 'answers.*', 'questions.*');
        dd($questionSample->get());
    }
    // public function createQuestion($questionArr) {
    //     $newQues = new Question();
    // }

}
