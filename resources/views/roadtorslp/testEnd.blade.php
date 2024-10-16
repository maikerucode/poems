@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-1/2">
            <h1 class="text-4xl font-bold text-left">Good Work!</h1>
            <p class="text-lg text-left align-text-bottom italic text-gray-400">finished in {{ $finish_time->diff($end_time) }}</p>
            <div class="p-4 my-1 card-body rounded-lg bg-pink-200 drop-shadow-md items-center">
                <div class="m-2 mb-2 px-4 py-2 card-body rounded-lg bg-pink-100 drop-shadow-md">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="text-4xl font-bold text-left">Score:</h1>
                        </div>
                        <div class="flex">
                            <h1 class="text-4xl text-right">{{ $score }}/{{ $total_items }}</h1>
                            <h1 class="ml-2 text-4xl text-right font-light italic text-gray-400">({{ $percentage }})</h1>
                        </div>
                    </div>
                </div>
                <!-- <div class="m-2 px-4 py-2 card-body rounded-lg">
                    <h1 class="mt-2 text-m font-bold text-left">Highest Score Achieved:</h1>
                </div> -->
                <div class="m-2 px-4 card-body rounded-lg flex justify-end">
                    <!-- <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-pink-500 rounded-lg border border-pink-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-15 h-10">Review Answers</button> -->
                    <!-- <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-pink-500 rounded-lg border border-pink-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-15 h-10">Retry</button> -->
                     <form action="{{ route('exam.home') }}" type="GET">
                         <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-purple-500 rounded-lg border border-purple-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-15 h-10">Back to Home</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection