<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('poems.store') }}">
            @csrf
            <input
                name="title"
                placeholder="{{ __('Enter title') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                style="filter: drop-shadow(1px 2px 1px #000000);"
            >
            <textarea
                name="poem_proper"
                placeholder="{{ __('New poem?') }}"
                class="mt-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                rows="5"
                style="filter: drop-shadow(1px 2px 1px #000000);"
            >{!! nl2br(e(old('poem_proper'))) !!}</textarea>
            <x-input-error :messages="$errors->get('poem_proper')" class="mt-2" />
            <x-primary-button class="mt-4" style="filter: drop-shadow(1px 2px 1px #000000);">{{ __('confirm') }}</x-primary-button>
        </form>
        @foreach ($poems as $poem)
        <div class="mt-4 bg-white shadow-sm rounded-lg divide-y" style="filter: drop-shadow(1px 2px 1px #000000);">
                <div class="p-6 flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#de88a2" stroke="#de88a2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    <!-- <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/449310726_8363176893710987_3389197404280771173_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeG1zGP0qQuqjxQBDXKeJkgTFlRzHjIbj9MWVHMeMhuP037BpApCUCZj_qYEWsvJVuhayRPB2cs4xJZhBiOFpSvj&_nc_ohc=uSMXRuF553wQ7kNvgHDd97t&_nc_ht=scontent.fmnl17-3.fna&oh=00_AYDNl7xL2irP5Mv66jy1g-u8VSpxaBMUHgn-iGJxINfDtg&oe=66899249" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" /> -->
                    <div class="flex-1 ml-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $poem->title }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $poem->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($poem->created_at->eq($poem->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                            @if (auth()->check() && auth()->user()->role === 'admin')
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('poems.edit', $poem)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('poems.destroy', $poem) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('poems.destroy', $poem)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{!! nl2br(e($poem->poem_proper)) !!}</p>
                    </div>
                </div>
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
            @endforeach
        <br>
        {{ $poems->links() }}
    </div>
</x-app-layout>