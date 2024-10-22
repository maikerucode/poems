@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-3/4">
                <h1 class="text-4xl font-bold text-left">{{ $curr_date }}</h1>
                <p class="text-left text-gray-400">{{$remaining_days}} days until Board Exam Day 1</p>
                <div class="p-4 my-1.5 card-body rounded-lg bg-pink-200 drop-shadow-md">
                    <h1 class="text-3xl font-bold text-left mx-1">What to do today?</h1>
                    <div class="flex my-1 h-[600px]">
                        <div class=" flex flex-col w-1/2 m-1 my-1 py-1 px-4 card-body rounded-lg bg-pink-100 drop-shadow-md">
                            <div class="flex">
                                <p class="text-left text-lg font-bold">Practice Tests</p>
                                <p class="mx-2 text-lg align-text-bottom italic text-gray-400">(select topics)</p>
                            </div>
                            <div>
                                <form action="{{ route('exam.makeTemp') }}" method="post">
                                    @csrf                             
                                    <div class="relative overflow-x-auto">
                                        <table class="w-full text-sm text-left bg-pink-100">
                                            <tbody>
                                                @foreach ($categories as $category)
                                                <tr class="bg-pink-100">
                                                    <td class="flex-shrink-0 max-w-fit py-2 px-2">
                                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                                    </td>
                                                    <td class="flex-grow py-2 px-2 cursor-default select-none">
                                                        {{$category->category_name}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex justify-stretch">
                                        <input type="hidden" name="time_limit" id="selectedTimeLimit">                                        
                                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="mr-2 text-black bg-pink-300 hover:bg-pink-300 focus:ring-4 focus:outline-none focus:ring-pink-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center my-2 h-10" type="button">
                                            <span id="selectedTime">Select Time Limit</span>     
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                        </button>
                                        <div class="flex items-center">
                                            <input type="text" id="simple-search" name="ques_num" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 ps-10 p-2.5 h-10" placeholder="# of Questions" required />
                                            <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-pink-600 rounded-lg border border-pink-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-40 h-10">Generate Test</button>
                                        </div>                                    
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="w-1/2 m-1 my-1 ml-3 px-4 py-2  card-body rounded-lg border-2 bg-pink-100 drop-shadow-md max-h-screen overflow-y-auto">
                            @foreach ($final_tests as $final_test)
                                <a href="{{ route('exam.sampleQues', $final_test->id) }}" class="mt-2 cursor-pointer">
                                    <div class="mt-2 px-4 py-2 card-body rounded-lg bg-pink-300 drop-shadow-md flex justify-between">
                                        <div class="text-sm text-left truncate w-1/2">
                                            @php
                                                $originalString = $final_test->temptest->title; // Replace with the actual string
                                                preg_match('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $originalString, $matches);
                                                $timeString = $matches[1];

                                                $carbonTime = Carbon\Carbon::parse($timeString)->addHours(8);
                                                $convertedTime = $carbonTime->format('Y-m-d H:i:s');

                                                $convertedString = preg_replace('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $convertedTime, $originalString);
                                            @endphp
                                            {{ $convertedString }}
                                        </div>
                                        <div class="text-right text-xs">
                                            @php
                                                $currentDateTime = Carbon\Carbon::now();
                                                $difference = $currentDateTime->diff($final_test->end_time);
                                                $num_of_ques = $final_test->temptest->questions()->count();
                                            @endphp
                                            
                                            <div>
                                                @if (!$difference->invert)
                                                    @if ((($final_test->current_ques + 1)  == $num_of_ques) &&($final_test->is_graded)) 
                                                        Test Finished!
                                                    @else
                                                        Q#{{ $final_test->current_ques + 1 }}
                                                    @endif
                                                @else
                                                    Time's Up! 
                                                @endif
                                            </div>
                                            <div>
                                        @if(!$final_test->is_graded)
                                            @if ($final_test->end_time)
                                                @if (!$difference->invert)
                                                    @if ($difference->h)
                                                        {{ $difference->h }} :
                                                    @endif
                                                    @if ($difference->i)
                                                        {{ $difference->i }} :
                                                    @endif
                                                    @if ($difference->s)
                                                        {{ $difference->s }}
                                                    @endif
                                                    remaining
                                                @elseif ($final_test->is_graded)
                                                    Score: {{ $final_test->score }}/{{ $num_of_ques }}        
                                                @else
                                                    Score: {{ $final_test->score }}/{{ $num_of_ques }}
                                                @endif
                                            @else
                                                @if ($final_test->is_graded)
                                                    Score: {{ $final_test->score }}/{{ $num_of_ques }}        
                                                @else
                                                    Score: {{ $final_test->score }}/{{ $num_of_ques }}
                                                @endif
                                            @endif
                                        @else
                                            Score: {{ $final_test->score }}/{{ $num_of_ques }}
                                        @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-1 flex flex-wrap">
                                        @foreach ($final_test->temptest->categories as $category)
                                            <div class="ml-1 mt-2 rounded-full px-4 py-1 text-center text-2xs bg-pink-200 text-black shadow-md">
                                                {{$category->category_name}}
                                            </div>
                                        @endforeach
                                    </div>
                                </a>
                                <div class="flex-grow border-t border-gray-300 mt-3"></div>
                            @endforeach
                    </div>
                </div>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="drop-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" value="1:00:00">1:00:00</a>
                    </li>
                    <li>
                        <a href="#" class="drop-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" value="1:30:00">1:30:00</a>
                    </li>
                    <li>
                        <a href="#" class="drop-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" value="2:00:00">2:00:00</a>
                    </li>
                    <li>
                        <a href="#" class="drop-option block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" value="No Limit">No Limit</a>
                    </li>
                    </ul>
                </div>
        </div>
    </div>
</div>
@include('scripts.examhome')
@endsection
