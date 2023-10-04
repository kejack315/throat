<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight text-xl text-gray-800 dark:text-gray-200">
            {{ __('Definitions') }}
        </h2>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800 dark:text-gray-200 font-bold">
            {{ __('Edit') }}
        </h3>

        @if($errors->any())
            <div class="flex flex-col gap-4 bg-red-200 text-red-800 my-4">
                @foreach($errors->all() as $error)
                    <p class='p-4'>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('definitions.update.patch', ['definition' => $definition]) }}"
              class="flex flex-col w-full gap-4">
            @csrf
            @method('PATCH')

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="word" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Word") }}
                </label>
                <input id="word" name="word" type="text" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900"
                       value="{{ old('word') ?? $definition->word->word }}"/>
            </div>

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="definition" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Definition") }}
                </label>
                <input id="definition" name="definition" type="text" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900"
                       value="{{ old('definition') ?? $definition->definition }}">
            </div>

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="stars" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Rating") }}
                </label>
                <select id="stars" name="stars" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900">
                    @for ($i = 0; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('stars') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>


            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="word_type" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Word Type") }}
                </label>
                <select id="word_type" name="word_type" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900">
                    <option value="">Select a Word Type</option>
                    @foreach($wordTypes as $type)
                        <option value="{{ $type->name }}" {{ $definition->word->word_type == $type->name ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-row rounded-md">
                <a href="{{ route('definitions.index') }}"
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
