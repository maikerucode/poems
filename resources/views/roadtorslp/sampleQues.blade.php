@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-1/2">
            <div>
                <h1 class="text-4xl font-bold text-left">Question ID: {{ $question->id }} ({{ $ques_category->category_name }})</h1>
            </div>
            <div class="p-4 my-1.5 card-body rounded-lg bg-pink-200 drop-shadow-md">
                <div class="m-2 mb-3 px-4 py-2 card-body rounded-lg bg-pink-100 drop-shadow-md">
                    <h1 class="text-xl font-bold text-left"> {{ str_replace('|', "\n", $question->ques_body) }} </h1>
                </div>
                <div class="my-5 grid grid-cols-2 gap-4">
                    @foreach ($question->answers as $answer)
                        <div id="{{ $answer->id }}" class="text-md font-bold card-body rounded-lg bg-white border border-purple-600 text-purple-600 cursor-pointer">{{ $answer->answer_text }} ({{ $answer->id }})</div>
                    @endforeach                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#' + {{ $question->correct_ans }}).removeClass('bg-purple-600 text-white bg-white border-purple-600');
        $('#' + {{ $question->correct_ans }}).addClass('bg-green-600 text-white border-green-600');
    });
</script>

@endsection
