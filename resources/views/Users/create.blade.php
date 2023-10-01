<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight text-xl text-gray-800 dark:text-gray-200">
            {{ __('Users') }}
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

        <form method="POST" action="{{ route('users.store') }}" class="flex flex-col w-full gap-4">
            @csrf
            @method('POST')

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="name" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Name") }}
                </label>
                <input id="name" name="name" type="text" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md" value="{{ old('name') }}" required>
            </div>

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="password" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{ __("Password") }}
                </label>
                <input id="password" name="password" type="password" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md" value="{{ old('password') }}" required>
            </div>

            <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                <label for="email" class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                    {{__('Emails')}}
                </label>
                <input id="email" name="email" type="text" placeholder="Email" class="p-2 w-5/6 bg-gray-200 dark:bg-gray-900 rounded-r-md" value="{{ old('email') }}" required>
            </div>

            <div class="flex flex-row rounded-md">
                <a href="{{ route('users.index') }}" class="text-center p-2 grow rounded-l-md text-white bg-sky-500 hover:bg-sky-900 dark:bg-sky-800 dark:hover:bg-sky-500 transition ease-in-out duration-350">
                    <i class="fa fa-arrow-rotate-back"></i>
                    <span class="sr-only">Back</span>
                </a>

                <button type="submit" class="text-center p-2 grow text-white rounded-r-md bg-orange-500 hover:bg-orange-900 dark:bg-orange-800 dark:hover:bg-orange-500 transition ease-in-out duration-350">
                    <i class="fa fa-save"></i>
                    <span class="sr-only">Save</span>
                </button>
            </div>
        </form>
    </section>
</x-guest-layout>
