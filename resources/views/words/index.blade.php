<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold leading-tight
                    grow
                   text-xl text-gray-800 dark:text-gray-200">
                {{ __('Words') }}
            </h2>
            <p>
                <a href="{{ route('words.create') }}"
                   class="rounded-lg p-2 bg-blue-900 text-white
                        hover:bg-blue-100 hover:text-blue-900
                        transition ease-in-out duration-500"
                >Add New Word</a>
            </p>
        </div>
    </x-slot>
    <h1 class="text-3xl
    p-6 pt-0 mb-4
    text-green-600
    bg-stone-200
    dark:text-green-200 dark:bg-stone-800">Words</h1>
    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The Word "{{ session()->get('created') }} was created successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The Word "{{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif
    <table class="table w-full text-gray-900 dark:text-gray-200 ">
        <thead>
        <tr class="bg-stone-900 text-stone-300">
            <th class="p-2 text-left">Row</th>
            <th class="p-1 px-2 text-left">Word</th>
            <th class="p-1 px-2 text-left">Definition</th>
            <th class="p-1 px-2 text-left">WordType</th>
            <th class="p-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($words as $word)
            <tr>
                <td class="p-2 px-2">{{$loop->index + 1}}</td>
                <td class="p-2 px-2">{{ Str::limit($word->word, 30) }}</td>
                <td class="p-2 px-2">
                    {{ $word->definitionCount() }}
                </td>
                <td class="p-2 px-2">{{ optional($word->wordType)->name }}</td>
                <td class="p-2">
                    <a href="{{route('words.show',$word)}}"
                       class="text-center p-2 grow rounded-l-md
               bg-green-500 text-white dark:bg-green-800
                hover:bg-green-900 dark:hover:bg-green-500
                transition ease-in-out
                duration-350">            <i class="fa fa-eye" ></i>
                        <span class="sr-only">Show</span></a>

                    <a href="{{route('words.edit',['word'=>$word])}}"
                       class="text-center p-2 grow
               bg-orange-500 text-white dark:bg-orange-800
                hover:bg-orange-900 dark:hover:bg-orange-500
                transition ease-in-out
                duration-350">            <i class="fa fa-edit" ></i>
                        <span class="sr-only">Edit</span></a>

                    <a href="{{route('words.delete',['word'=>$word])}}"
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
        <tr>
            <td colspan="5" class="p-1">
                {{ $words->links() }}
            </td>
        </tr>
        </tfoot>
    </table>
</x-app-layout>
