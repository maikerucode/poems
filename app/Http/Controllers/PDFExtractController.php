<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PDFExtractController extends Controller
{
    public function parseQuestions(Request $request): array
    {

        // dd($request->file('examFile'));

        $questions = [];
        $currentQuestion = null;
        $isQuestionBody = false;
        
        // $filePath = public_path($filePath);
        $file = $request->file('examFile');
        $filePath = public_path($file->move('pdf', $file->getClientOriginalName()));
        // dd($filePath);
        $lines = file($filePath);
        // dd($lines);

        for ($index = 0; $index < count($lines); $index++) {
            $line = $lines[$index];
        
            if (preg_match('/^\d+\./', $line)) {
                // If there’s a current question, store it before starting a new one
                if ($currentQuestion != null && !$isQuestionBody) {
                    $questions[] = $currentQuestion;
                }
        
                // Initialize the current question
                $currentQuestion = [
                    'question' => $line,
                    'answers' => [],
                ];
        
                // Check for subsequent lines that also match the question pattern
                for ($i = $index + 1; $i < count($lines); $i++) {
                    if (preg_match('/^\d+\./', $lines[$i])) {
                        // Append the next question to the current question
                        $currentQuestion['question'] .= ' | ' . trim($lines[$i]); // Ensure a space and trim whitespace
                        // Move index to the end of the inner loop
                        $index = $i; // Update the outer loop index
                    } else {
                        break; // Break the inner loop when the pattern changes
                    }
                }
            } else if (preg_match('/^\s*\d+\.\s.*$/', $line)) {
                // If the line is an answer, add it to the current question
                if ($currentQuestion) {
                    $currentQuestion['answers'][] = trim($line);
                }
            }
        }
        File::delete($filePath);
        dd($questions);
        return $questions;
    }
    public function home() {

        // $config = new \Smalot\PdfParser\Config();
        // $config->setFontSpaceLimit(-60);

        // $parser = new \Smalot\PdfParser\Parser();
        // $pdf = $parser->parseFile(public_path('pdf\AnaPhy & NeuroAnaPhy (Post-Test) (1).pdf'));

        // $text = $pdf->getPages()[0]->getText();

        // $questions = $this->parseQuestions('pdf\AnaPhy & NeuroAnaPhy (Post-Test).txt');
        // dd($questions);

        return view('roadtorslp.pdfextract',
        );
    }

    // public function importQuestions() {
        
    // }

    // public function createQuestion($questionArr) {
    //     $newQues = new Question();
    // }

}
