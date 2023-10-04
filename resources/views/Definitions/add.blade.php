<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight
                   text-xl text-gray-800 dark:text-gray-200">
            {{ __('Definition') }}
        </h2>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800 dark:text-gray-200
                   font-bold">
            {{ __('Add') }}
        </h3>

        @if($errors->any())
            <div class="flex flex-col gap-4 bg-red-200 text-red-800 my-4 rounded-lg">
                @foreach($errors->all() as $error)
                    <p class="p-4">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('definitions_add.store', ['definition' => $definition]) }}"
            class="flex flex-col w-full gap-4">

            @csrf
            @method('POST')
            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="definition" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Definition") }}
                </label>
                <input id="definition" name="definition" type="text" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900"
                       value="{{ old('definition') ?? $definition->definition }}">
            </div>

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900" style="display: none;">
                <label for="word_type" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Word Type") }}
                </label>
                <input type="text" id="word_type" name="word_type" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900"
                       value="{{  old('word_type')??$definition->word->wordType->name  }}" />
            </div>

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900" style="display: none;">
                <label for="word" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Word") }}
                </label>
                <input id="word" name="word" type="text" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md"
                       value="{{ old('word') ?? $definition->word->word }}"/>
            </div>

            <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                <label for="Icon"
                       class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                    {{ __('Icon') }}
                </label>
                <select
                    id="Icon"
                    name="icon"
                    class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md">
                    <option value="lemon" @if(old('icon')? old('icon')=='lemon':false) selected @endif>Lemon</option>
                    <option value="star" @if(old('icon')? old('icon') == 'star':false) selected @endif>Star</option>
                    <option value="splotch" @if(old('icon')? old('icon') == 'splotch':false) selected @endif>Splotch
                    </option>
                    <option value="poo" @if(old('icon')? old('icon') == 'poo':false) selected @endif>Poo</option>
                    <option value="cloud" @if(old('icon')? old('icon') == 'cloud':false) selected @endif>Cloud</option>
                    <option value="ghost" @if(old('icon')? old('icon') == 'ghost':false) selected @endif>Ghost</option>
                    <option value="thumbs-up" @if(old('icon')? old('icon') == 'thumbs-up':false) selected @endif>Thumbs
                        Up
                    </option>
                    <option value="thumbs-down" @if(old('icon')? old('icon') == 'thumbs-down':false) selected @endif>
                        Thumbs
                        Down
                    </option>
                    <option value="" @if(old('icon')?old('icon')=='':false) selected @endif disabled>Select an icon
                    </option>
                </select>
            </div>

            <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
                <label
                    for=Stars"
                    class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                    {{__('Stars')}}
                </label>
                <input type="range"
                       id="Stars"
                       name="stars"
                       class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md"
                       min="0" max="10" value="{{ old('stars') ?? 0 }}">
            </div>

            <div class="flex flex-row rounded-md">

                <a href="{{ route('definitions.index') }}"
                   class="text-center p-2 grow rounded-l-md
                          text-white
                          bg-sky-500 hover:bg-sky-900
                          dark:bg-sky-800 dark:hover:bg-sky-500
                          transition ease-in-out duration-350">
                    <i class="fa fa-arrow-rotate-back"></i>
                    <span class="sr-only">Back</span>
                </a>

                <button
                    type="submit"
                    class="text-center p-2 grow
                       text-white rounded-r-md
                       bg-orange-500 hover:bg-orange-900
                       dark:bg-orange-800 dark:hover:bg-orange-500
                       transition ease-in-out duration-350">
                    <i class="fa fa-save"></i>
                    <span class="sr-only">Save</span>
                </button>

            </div>

        </form>

    </section>

</x-app-layout>
