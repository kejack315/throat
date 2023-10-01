<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight text-xl text-gray-800 dark:text-gray-200">
            {{ __('Words') }}
        </h2>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800 dark:text-gray-200 font-bold">
            {{ __('Create') }}
        </h3>

        @if($errors->any())
            <div class="flex flex-col gap-4 bg-red-200 text-red-800 my-4 rounded-lg">
                @foreach($errors->all() as $error)
                    <p class="p-4">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('words.store') }}" class="flex flex-col w-full gap-4">
            @csrf
            @method('POST')

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="word" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Word") }}
                </label>
                <input id="word" name="word" type="text" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md"
                       value="{{ old('word') }}" required>
            </div>
            {{--                        @foreach($word->definitions as $definition)--}}
            {{--                            {{ $definition->definition }}--}}
            {{--                        @endforeach--}}
            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="definition" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Definition") }}
                </label>
                <input id="definition" name="definition" type="text"
                       class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md" value="{{ old('definition') }}"
                       required>
            </div>

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="word_type" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __('Word_Type') }}
                </label>
                <select id="word_type" name="word_type" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md" required>
                    <option value="" disabled selected>Select Word Type</option>
                    @foreach($wordTypes as $key => $value)
                        <option value="{{ $key }}" {{ old('word_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>


            <div class="flex flex-row rounded-md">
                <a href="{{ route('words.index') }}"
                   class="text-center p-2 grow rounded-l-md text-white bg-sky-500 hover:bg-sky-900 dark:bg-sky-800 dark:hover:bg-sky-500 transition ease-in-out duration-350">
                    <i class="fa fa-arrow-rotate-back"></i>
                    <span class="sr-only">Back</span>
                </a>

                <button type="submit"
                        class="text-center p-2 grow text-white rounded-r-md bg-orange-500 hover:bg-orange-900 dark:bg-orange-800 dark:hover:bg-orange-500 transition ease-in-out duration-350">
                    <i class="fa fa-save"></i>
                    <span class="sr-only">Save</span>
                </button>
            </div>
        </form>
    </section>
</x-app-layout>
