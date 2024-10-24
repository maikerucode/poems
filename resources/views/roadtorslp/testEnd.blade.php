@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-1/2">
            <h1 class="text-4xl font-bold text-left">Good Work!</h1>
            <p class="text-lg text-left align-text-bottom italic text-gray-400">finished in {{  $start_time->diff($finish_time) }}</p>
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
                     <form action="{{ route('exam.testRetry', [$finaltest->id]) }}" type="GET">
                        <input type="hidden" name="time_limit" id="selectedTimeLimit">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black bg-pink-300 hover:bg-pink-300 focus:ring-4 focus:outline-none focus:ring-pink-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center my-2 h-10" type="button">
                            <span id="selectedTime">Select Time Limit</span>     
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>
                         <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-purple-500 rounded-lg border border-purple-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-15 h-10">Retry Test</button>
                     </form>
                     <form action="{{ route('exam.home') }}" type="GET">
                         <button type="submit" class="p-2.5 ms-2 mt-2 text-sm font-medium text-white bg-purple-500 rounded-lg border border-purple-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-15 h-10">Back to Home</button>
                     </form>
                </div>
            </div>
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

<script>
    const dropdownItems = document.querySelectorAll(".drop-option");

    dropdownItems.forEach(item => {
        item.addEventListener("click", function() {
            const selectedValue = this.getAttribute('value'); // Use getAttribute() to retrieve the value
            console.log("Selected Value:", selectedValue);

            document.getElementById("selectedTime").innerText = selectedValue;
            document.getElementById("selectedTimeLimit").value = selectedValue;

            // Close the dropdown
            const dropdown = document.getElementById("dropdown");
            dropdown.classList.add("hidden");
        });
    });
</script>

@endsection