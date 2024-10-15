@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-3/4">
                <h1 class="text-4xl font-bold text-left">{{ $curr_date }}</h1>
                <p class="text-left text-gray-400">{{$remaining_days}} days until Board Exam Day 1</p>
                <div class="p-4 my-1.5 card-body rounded-lg bg-pink-200 drop-shadow-md">
                    <h1 class="text-3xl font-bold text-left mx-1">What to do today?</h1>
                    <div class="flex my-1">
                        <div class="w-1/2 m-2 px-4 py-2 card-body rounded-lg bg-pink-100 drop-shadow-md">
                            <div class="flex">
                                <p class="text-left text-lg font-bold">Practice Tests</p>
                                <p class="mx-2 text-lg align-text-bottom italic text-gray-400">(select topics)</p>
                            </div>
                            <div>
                                <form action="{{ route('exam.makeTemp') }}" method="get">                                
                                    <div class="relative overflow-x-auto">
                                        <table class="w-full text-sm text-left bg-pink-100">
                                            <tbody>
                                                @foreach ($categories as $category)
                                                <tr class="bg-pink-100">
                                                    <td class="flex-shrink-0 max-w-fit py-2 px-2">
                                                        <input type="checkbox" name="categories" id="">
                                                    </td>
                                                    <td class="flex-grow py-2 px-2">
                                                        {{$category->category_name}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <input type="hidden" name="time_limit" id="selectedTimeLimit">                                        
                                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black bg-pink-300 hover:bg-pink-300 focus:ring-4 focus:outline-none focus:ring-pink-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center my-2" type="button">Select Time Limit <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
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
                        <div class="w-1/2 m-2 px-4 py-2 card-body rounded-lg border-2 bg-pink-100 drop-shadow-md">
                            <div class="mt-2 cursor-pointer">
                                <div class="px-4 py-2 card-body rounded-lg bg-pink-300 drop-shadow-md flex justify-between">
                                    <div class="text-sm truncate w-1/2">
                                        Anaphy & Neuro0a0awdlkjnawoduihnawdi iuhawdiouawhd auidh aui
                                    </div>
                                    <div class="text-right text-xs">
                                        <div>
                                            Q2
                                        </div>
                                        <div>
                                            hh:mm (hh:mm) remaining
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1 flex flex-wrap">
                                    <div class="ml-1 mt-1 rounded-full px-4 py-1 text-center text-2xs bg-pink-200 text-black">
                                        Category
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="px-4 py-2 card-body rounded-lg bg-pink-300 drop-shadow-md flex justify-between">
                                    <div class="text-sm truncate w-1/2">
                                        Anaphy & Neuro0a0awdlkjnawoduihnawdi iuhawdiouawhd auidh aui
                                    </div>
                                    <div class="text-right text-xs">
                                        <div>
                                            Q2
                                        </div>
                                        <div>
                                            Done (View Questions)
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1 flex flex-wrap">
                                    <div class="ml-1 mt-1 rounded-full px-4 py-1 text-center text-2xs bg-pink-200 text-black">
                                        Category
                                    </div>
                                    <div class="ml-1 mt-1 rounded-full px-4 py-1 text-center text-2xs bg-pink-200 text-black">
                                        Category
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">1:00:00</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">1:30:00</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">2:00:00</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">No Limit</a>
                    </li>
                    </ul>
                </div>
        </div>
    </div>
</div>
@endsection

@include('scripts.examhome')