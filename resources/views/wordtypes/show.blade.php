<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight text-xl text-gray-800 dark:text-gray-200">
            {{ __('WordType') }}
        </h2>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800 dark:text-gray-200 font-bold">
            Details
        </h3>

        <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                Word_Type
            </p>
            <p class="p-2 w-5/6 text-white">{{ $wordType->name }}</p>
        </div>


{{--        <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">--}}
{{--            <label for="word_type" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">--}}
{{--                {{ __('Word_Type') }}--}}
{{--            </label>--}}
{{--            <select id="word_type" name="word_type" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md text-white" required>--}}
{{--                <option value="" disabled selected>Select Word Type</option>--}}
{{--                @foreach($wordTypes as $wordType)--}}
{{--                    <option value="{{ $wordType->id }}" {{ old('word_type') == $wordType->id ? 'selected' : '' }}>{{ $wordType->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        --}}


        <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                Definition
            </p>
            <p class="p-2 w-5/6 text-white">
                @foreach($wordType->words as $word)
                    @foreach($word->definitions as $definition)
                        {{ Str::limit($definition->definition, 50) }}<br>
                    @endforeach
                @endforeach
            </p>
        </div>

        <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                Created At
            </p>
            <p class="p-2 w-5/6 text-white">{{ $wordType->created_at }}</p>
        </div>

        <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                Updated At
            </p>
            <p class="p-2 w-5/6 text-white">{{ $wordType->updated_at }}</p>
        </div>

        <p class="flex flex-row md:w-13 w-full rounded-md">
            <a href="{{ route('wordtypes.index') }}"
               class="text-center p-2 grow rounded-l-md text-white bg-sky-500 hover:bg-sky-900 dark:bg-sky-800 dark:hover:bg-sky-500 transition ease-in-out duration-350">
                <i class="fa fa-arrow-rotate-back"></i>
                <span class="sr-only">Back</span>
            </a>

            <a href="{{ route('wordtypes.edit', $wordType) }}"
               class="text-center p-2 grow text-white bg-orange-500 hover:bg-orange-900 dark:bg-orange-800 dark:hover:bg-orange-500 transition ease-in-out duration-350">
                <i class="fa fa-edit"></i>
                <span class="sr-only">Edit</span>
            </a>

            <a href="{{ route('wordtypes.delete', $wordType) }}"
               onclick="return confirm('Delele Confirm?');"
               class="text-center p-2 grow rounded-r-md text-white bg-red-500 hover:bg-red-900 dark:bg-red-800 dark:hover:bg-red-500 transition ease-in-out duration-350">
                <i class="fa fa-times"></i>
                <span class="sr-only">Delete</span>
            </a>

        </p>
    </section>
</x-app-layout>
