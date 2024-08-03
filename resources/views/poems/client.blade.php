<style>
    @media screen and (max-width:480px) {
        .mobile-text {
            max-width: 80%;
        }
    }
</style>

<x-app-layout>
    <div align="center">
        <div class="mobile-text max-w-2xl p-4 sm:p-6 lg:p-8" 
            style="
            border-radius: 10px; 
            background-image: linear-gradient(to right, #AB336B, #335BAB); 
            margin: 20px 30px 0px; 
            filter: drop-shadow(1px 3px 10px #000000);
            ">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            <p class="text-xl text-black-700 mt-1" style="color: white;"><u>{{ $poem->title }}</u></p>
            <!-- <p class="mt-4 text-white">{{ $poem->poem_proper }}</p> -->
            <p class="text-md mt-4 text-white">{!! nl2br(e($poem->poem_proper)) !!}</p>
            @if($poem->tags->isNotEmpty())
                    <div class="py-2 mr-3 flex">
                        @foreach ($poem->tags as $tag)
                            <div class="ml-2 rounded-lg shadow-sm" style="background-color: pink;">
                                <p class="ml-2 mr-2 text-sm text-gray-900">{{ $tag->name }}</p>
                            </div>
                        @endforeach
                </div>
                @endif
        </div>
        <div class="max-w-2xl mx-auto sm:p-6 lg:p-8" style="margin-bottom: 18px; max-width: 50%;">
            <br>
            <form action="">
                <x-primary-button class="mt-2" style="filter: drop-shadow(1px 1px 1px #000000);">{{ __('Generate New Poem') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>