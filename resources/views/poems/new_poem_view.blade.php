<x-app-layout>

<div align="center">
@foreach ($poems as $poem)
        <div class="mt-4 bg-white shadow-sm rounded-lg divide-y max-w-2xl" style="filter: drop-shadow(1px 2px 1px #000000);">
                <div class="p-6 flex space-x-2 max-w-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#de88a2" stroke="#de88a2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    <!-- <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/449310726_8363176893710987_3389197404280771173_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeG1zGP0qQuqjxQBDXKeJkgTFlRzHjIbj9MWVHMeMhuP037BpApCUCZj_qYEWsvJVuhayRPB2cs4xJZhBiOFpSvj&_nc_ohc=uSMXRuF553wQ7kNvgHDd97t&_nc_ht=scontent.fmnl17-3.fna&oh=00_AYDNl7xL2irP5Mv66jy1g-u8VSpxaBMUHgn-iGJxINfDtg&oe=66899249" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> -->
                    <div class="flex-1 ml-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $poem->title }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ \Carbon\Carbon::parse($poem->created_at)->addHours(8)->format('Y-m-d H:i:s') }}</small>
                                @if(\Carbon\Carbon::parse($poem->created_at)->addHours(8)->greaterThanOrEqualTo(\Carbon\Carbon::now()->subWeek()))
                                <small class="ml-2">(Recently Added)</small>
                                @endif
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{!! nl2br(e($poem->poem_proper)) !!}</p>
                    </div>
                </div>
                @php
                    $tags = str_replace(["[", "]", "\""], "", $poem->tags_list);
                    $tags = str_replace([", ", ","], " ", $tags);
                    $tags = explode("//", $tags);
            @endphp
                <div class="py-2 mr-3 flex">
                    @foreach ($tags as $tag)
                        @if ($loop->last)
                            @break
                        @endif
                        <div class="ml-2 rounded-lg shadow-sm" style="background-color: pink;">
                            <p class="ml-2 mr-2 text-sm text-gray-900">{{ $tag }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
</div>
</x-app-layout>