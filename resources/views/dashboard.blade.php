<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h1 class="text-3xl p-6 pt-0 mb-4 text-green-600 bg-stone-200 dark:text-green-200 dark:bg-stone-800">Login Success</h1>

    <table class="table w-full text-gray-900 dark:text-gray-200">
        <thead>
        <tr class="bg-stone-900 text-stone-300">
            <th class="p-1 px-2 text-left">User Information</th>
            <th class="p-1 px-2 text-right">Statistics</th>
        </tr>
        </thead>
        <tbody>
        <tr >
            <td class="p-2 px-2 ">
                <div class="flex flex-col gap-2">
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900 ">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            Name:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            {{ $user->name }}
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            Email:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            {{ $user->email }}
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            Definitions:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            {{ $definitions->count() }}
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            Words:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            {{ $words->count() }}
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            WordTypes:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            {{ $wordTypes->count() }}
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            Top 5 Defined Words:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            @foreach ($topDefinedWords as $word)
                                {{ $word->word }}<br>
                            @endforeach
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            Top 5 Highest Rated Definitions:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            @foreach ($topRatedDefinitions as $definition)
                                {{ $definition->definition }}<br>
                            @endforeach
                        </p>
                    </div>
                    <div class="flex flex-row gap-4 rounded-md bg-gray-200 dark:bg-gray-900">
                        <p class="p-2 w-1/6 rounded-l-md bg-gray-500 dark:bg-gray-800 text-gray-100">
                            Your Permissions:
                        </p>
                        <p class="p-2 w-5/6 text-white text-right">
                            @foreach ($permissions as $permission)
                                {{ $permission }}<br>
                            @endforeach
                        </p>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
        </tr>
        </tfoot>
    </table>


</x-app-layout>
