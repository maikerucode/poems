@extends('layouts.app_exam')

@section('content')

<div class="container justify-content-center" align="center">
    <div class="card">
        <div class="p-4 card-body w-1/2">
                <h1 class="text-4xl font-bold text-left">Import Exams Here</h1>
                <div class="p-4 my-1.5 card-body rounded-lg bg-pink-200 drop-shadow-md items-center">
                <form action="/roadtorslp/import/file_inp" method="post" enctype="multipart/form-data">
                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <label class="block items-center">
                    <input name="examFile" type="file" class="block w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-violet-50 file:text-violet-700
                    hover:file:bg-violet-100
                    "/>
                <label for="categories" class="block mb-2 text-sm font-medium"></label>
                <select id="categories" name="category" class="bg-pink-300 text-sm rounded-lg focus:ring-pink-400 focus:border-pink-400 block w-full p-2.5">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                </label>
                <button type="submit" class="mt-3 p-2.5 ms-2 text-sm font-medium text-white bg-pink-600 rounded-lg border border-pink-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-40 h-10">Generate Test</button>
                </form>
                </div>
        </div>
    </div>
    <div class="card">
        <div class="p-4 card-body w-1/2">
                <h1 class="text-2xl font-bold text-left">Available Tests</h1>
                <div class="p-4 my-1.5 card-body rounded-lg bg-pink-200 drop-shadow-md items-center">
                    @foreach ($temptests as $temptest)
                        <div class="flex justify-between ma-1.5 py-4 px-2 card-body rounded-lg bg-white drop-shadow-md">
                            <h1 class="mt-3 flex-grow-0 ml-4 text-2xl font-bold text-left"> {{ $temptest->title }} </h1>
                            <a href="" class="mt-2 mr-4 flex-grow-0 text-white bg-pink-700 hover:bg-pink-800 focus:outline-none focus:ring-4 focus:ring-pink-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-900">Preview Test</a>
                        </div>
                    <div class="flex flex-row">
                        @foreach ($temptest->categories as $category)
                        <div class="mr-2 mt-4">
                            <div class="rounded-full px-4 py-1 text-center text-sm bg-pink-400 text-black">
                                {{ $category->category_name }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
        </div>
    </div>
</div>
@endsection