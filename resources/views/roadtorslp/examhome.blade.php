@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-1/2">
                <h1 class="text-4xl font-bold text-left">September 23, 2024</h1>
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
                                <form action="" method="get">                                
                                    <div class="relative overflow-x-auto">
                                        <table class="w-full text-sm text-left bg-pink-100">
                                            <tbody>
                                                @foreach ($categories as $category)
                                                <tr class="bg-pink-100">
                                                    <td class="flex-shrink-0 max-w-fit py-2 px-2">
                                                        <input type="checkbox" name="" id="">
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
                                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black bg-pink-300 hover:bg-pink-300 focus:ring-4 focus:outline-none focus:ring-pink-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center my-2" type="button">Select Time Limit <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                        </button>
                                        <div class="flex items-center">
                                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 ps-10 p-2.5 h-10" placeholder="# of Questions" required />
                                            <button id="generate_test" type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-pink-600 rounded-lg border border-pink-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-40 h-10">Generate Test</button>
                                        </div>                                    
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="w-1/2 m-2 px-4 py-2 card-body rounded-lg border-2 bg-pink-100 drop-shadow-md">
                            insert form to select previous test attempts (finished FinalTest)
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