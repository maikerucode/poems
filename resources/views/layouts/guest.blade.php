<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>🤍 My Gift to You 🤍</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900" style="background-image: linear-gradient(to right, #AB336B, #335BAB);">
            <div align="center">
            <!-- <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" width="150" height="150" viewBox="0 0 512 512" stroke="#1f2937" stroke-width="2" style="filter: drop-shadow(1px 2px 1px #000000);"><path d="m256.002 242.913 210.412-121.43L256.002 0 45.586 121.483zm-15.053 26.073L30.534 147.557v242.96L240.949 512zm30.107 0V512l210.41-121.483v-242.96z" fill="url(&quot;#SvgjsLinearGradient1043&quot;)"></path><defs><linearGradient id="SvgjsLinearGradient1043"><stop stop-color="#1f2937" offset="0"></stop><stop stop-color="#1f2937" offset="1"></stop></linearGradient></defs></svg> -->
            <img src="{{ asset('favicon.ico') }}" alt="" width="180" height="180" style="filter: drop-shadow(1px 2px 5px #000000);">
            </div>
            <br>

            <div class="w-max sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg" style="filter: drop-shadow(1px 2px 1px #000000);">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
