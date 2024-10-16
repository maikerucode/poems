@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-1/2">
            <h1 class="text-4xl font-bold text-left">Question {{ $finaltest->current_ques + 1 }} of {{ $question_count }}</h1>
            <div class="mt-1 flex justify-between">
                <div class="flex">
                    <p class="mr-1 text-lg align-text-bottom italic text-gray-400 text-left">Selected Topics: </p>
                    <div class="flex">
                        @foreach ($finaltest->temptest->categories as $category)
                            <div class="ml-1 mt-1 rounded-full px-4 py-1 text-center text-xs bg-pink-200 text-black">
                                {{$category->category_name}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                @php
                    $currentDateTime = Carbon\Carbon::now();
                    $difference = $currentDateTime->diff($finaltest->end_time);
                @endphp
                    <span id="rem_time" class="mr-1 text-lg align-text-bottom italic text-gray-400 text-left">
                    @if (!$difference->invert)
                        Remaining Time:
                        @if ($difference->h)
                            {{ $difference->h }} :
                        @endif
                        @if ($difference->i)
                            {{ $difference->i }} :
                        @endif
                        @if ($difference->s)
                            {{ $difference->s }}
                        @endif
                    @else
                        Time's Up!
                    @endif
                    </span>
                </div>
            </div>
            <div class="p-4 my-1.5 card-body rounded-lg bg-pink-200 drop-shadow-md">
                <div class="m-2 mb-3 px-4 py-2 card-body rounded-lg bg-pink-100 drop-shadow-md">
                    <h1 class="text-xl font-bold text-left"> {{ str_replace('|', "\n", $question->ques_body) }} </h1>
                </div>
                <div class="my-5 grid grid-cols-2 gap-4">
                    @foreach ($question->answers as $answer)
                        <div id="ans_{{ $answer->id }}" class="text-md font-bold card-body rounded-lg bg-white border border-purple-600 text-purple-600 cursor-pointer">{{ $answer->answer_text }}</div>
                    @endforeach                    
                </div>
                <div class="mt-4 card-body rounded-lg flex justify-end">
                    <button class="confirm-ans p-2.5 ms-2 text-sm font-medium text-white bg-pink-500 rounded-lg border border-pink-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-15 h-10">Confirm</button>
                    <form action="{{ route('exam.nextQues') }}" method="POST">
                        @csrf
                        <input type="hidden" id="isCorrect" name="isCorrect" value="">
                        <input type="hidden" name="finaltest_id" value="{{ $finaltest->id }}">
                        <button type="submit" class="nextQues-btn hidden p-2.5 ms-2 text-sm font-medium text-white bg-purple-500 rounded-lg border border-purple-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-15 h-10">Next Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('scripts.question-scripts')
@endsection
