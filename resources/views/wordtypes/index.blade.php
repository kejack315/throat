<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold leading-tight
                    grow
                   text-xl text-gray-800 dark:text-gray-200">
                {{ __('WordType') }}
            </h2>
            <p>
                <a href="{{ route('wordtypes.create') }}"
                   class="rounded-lg p-2 bg-blue-900 text-white
                        hover:bg-blue-100 hover:text-blue-900
                        transition ease-in-out duration-500"
                >Add New WordType</a>
            </p>
        </div>
    </x-slot>
    <h1 class="text-3xl
    p-6 pt-0 mb-4
    text-green-600
    bg-stone-200
    dark:text-green-200 dark:bg-stone-800">WordType</h1>

    <table class="table w-full  text-gray-900 dark:text-gray-200 ">
        <thead>
        <tr class="bg-stone-900 text-stone-300">
            <th class="p-1 px-2 text-left">Name</th>
            <th class="p-1 text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($wordTypes as $wordType)
        <tr>
            <td class="p-1 px-2 ">{{ $wordType->name }}</td>
            <td class="p-1  text-right">
                <a href="{{route('wordtypes.show',['wordType'=>$wordType])}}"
                   class="text-center p-2 grow rounded-l-md
               bg-green-500 text-white dark:bg-green-800
                hover:bg-green-900 dark:hover:bg-green-500
                transition ease-in-out
                duration-350">            <i class="fa fa-eye" ></i>
                    <span class="sr-only">Show</span></a>

                <a href="{{route('wordtypes.edit',['wordType'=>$wordType])}}"
                   class="text-center p-2 grow
               bg-orange-500 text-white dark:bg-orange-800
                hover:bg-orange-900 dark:hover:bg-orange-500
                transition ease-in-out
                duration-350">            <i class="fa fa-edit" ></i>
                    <span class="sr-only">Edit</span></a>

                <a href="{{route('wordtypes.delete',['wordType'=>$wordType])}}"
                   class="text-center p-2 grow rounded-r-md
               bg-red-500 text-white dark:bg-red-800
                hover:bg-red-900 dark:hover:bg-red-500
                transition ease-in-out
                duration-350">            <i class="fa fa-times" ></i>
                    <span class="sr-only">Delete</span></a>
            </td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr class="bg-stone-700 text-stone-400">
            <td class="p-1" colspan="3">
                {{ $wordTypes->links() }}
            </td>
        </tr>
        </tfoot>
    </table>

</x-app-layout>
