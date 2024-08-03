<x-app-layout>
    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> -->

    <div align="center">
        <div class="mobile-text max-w-2xl p-4 sm:p-6 lg:p-8" 
            style="
            border-radius: 10px; 
            background-image: linear-gradient(to right, #AB336B, #335BAB); 
            margin: 20px 30px 0px; 
            filter: drop-shadow(1px 3px 10px #000000);
            ">
        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> -->
        <img src="{{ asset('/img/sugar_cub.png/') }}" alt="" style="max-width: 200px;">
            <p class="text-xl text-black-700 mt-1" style="color: white;">
                Welcome!
            </p>
            <p class="text-md mt-4 text-white" style="text-align: justify; text-justify: inter-word;">
                It took quite a while to make but here it is!

                <br><br>

                Let me introduce you to your very own site to view poems! This site 
                allows you to look through both old and new poems which I have created. I hope you enjoy every bit of it.
            </p>

            <p class="text-md mt-4 text-white" style="text-align: center;">

                I love you so muchh!

            </p>

            <p class="text-md mt-4 text-white" style="text-align: justify; text-justify: inter-word;">

                I will probably still work on improvements to the site over time as I think of new additions.

            </p>
            
        </div>
    </div>

</x-app-layout>
