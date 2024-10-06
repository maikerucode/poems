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
                </label>
                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-pink-600 rounded-lg border border-pink-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-40 h-10">Generate Test</button>
                </form>
                </div>
        </div>
    </div>
</div>
@endsection