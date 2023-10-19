<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight
                   text-xl text-gray-800 dark:text-gray-200">
            {{ __('Ratings') }}
        </h2>
    </x-slot>

    <section class="w-full p-6 flex flex-col gap-4">
        <h3 class="text-lg text-gray-800 dark:text-gray-200
                   font-bold">
            {{ __("Delete") }}
        </h3>

        <p class="text-lg bg-red-500 text-white py-6 px-4 mb-6 rounded-lg">Please confirm you wish to delete this
            rating.</p>

        <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                Name
            </p>
            <p class="p-2 w-5/6 text-white">{{ $rating->name }}</p>
        </div>

        <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                Icon
            </p>
            <p class="p-2 w-5/6 text-white">
                (<i class="fa fa-{{$rating->icon}}"></i>) {{ $rating->icon }}
            </p>
        </div>

        <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                Stars
            </p>
            <p class="p-2 w-5/6 text-white">{{ $rating->stars }} </p>
        </div>

        <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                Created At
            </p>
            <p class="p-2 w-5/6 text-white">{{ $rating->created_at }} </p>
        </div>

        <div class="flex flex-row gap-4 rounded-md
                    bg-gray-200 dark:bg-gray-900">
            <p class="p-2 w-1/6 rounded-l-md
                      bg-gray-500 dark:bg-gray-800
                      text-gray-100">
                Updated At
            </p>
            <p class="p-2 w-5/6 text-white">{{ $rating->updated_at }} </p>
        </div>

        <p class="flex flex-row md:w-13 w-full rounded-md">

        <form
            method="POST"
            action="{{ route('ratings.destroy', ['rating'=>$rating]) }}"
            class="flex flex-col w-full gap-4">

            @csrf
            @method('DELETE')

            <div class="flex flex-row rounded-md">

                <a href="{{ route('ratings.index') }}"
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
                       bg-red-500 hover:bg-red-900
                       dark:bg-red-800 dark:hover:bg-red-500
                       transition ease-in-out duration-350">
                    <i class="fa fa-save"></i>
                    <span class="sr-only">Save</span>
                </button>

            </div>

        </form>

        </p>
    </section>

</x-app-layout>
