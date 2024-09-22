@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-1/2">
                <h1 class="text-4xl font-bold text-left">September 23, 2024</h1>
                <p class="text-left text-gray-400">XX days until Board Exam Day 1</p>
                <div class="p-4 my-1.5 card-body rounded-lg bg-pink-200 drop-shadow-md">
                    <h1 class="text-3xl font-bold text-left mx-1">What to do today?</h1>
                    <div class="flex my-1">
                        <div class="w-1/2 m-2 px-4 py-2 card-body rounded-lg bg-pink-100 drop-shadow-md">
                            <div class="flex">
                                <p class="text-left text-lg font-bold">Practice Tests</p>
                                <p class="mx-2 text-lg align-text-bottom italic text-gray-400">(select topics)</p>
                            </div>
                            <div>
                                insert form to start FinalTest here
                            </div>
                        </div>
                        <div class="w-1/2 m-2 px-4 py-2 card-body rounded-lg border-2 bg-pink-100 drop-shadow-md">
                            insert form to select previous test attempts (finished FinalTest)
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection