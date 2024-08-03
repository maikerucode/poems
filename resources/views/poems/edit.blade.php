<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('poems.update', $poem) }}">
            @csrf
            @method('patch')
            <input
                name="title"
                placeholder="{{ __('Enter title') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{ old('title', $poem->title) }}"
            >
            <textarea
                name="poem_proper"
                class="mt-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                rows="5"
            >{{ old('poem_proper', $poem->poem_proper) }}</textarea>

            <label for="tags" class="block text-sm font-medium text-gray-700 mt-4">Tags</label>
            <select name="tags[]" id="tags" multiple class="form-multiselect block w-full mt-1">
                @foreach ($allTags as $tag)
                    <option value="{{ $tag->id }}" {{ $poem->tags->contains($tag->id) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('poem_proper')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <x-primary-button>
                    <a href="{{ route('poems.index') }}">{{ __('Cancel') }}</a>
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>