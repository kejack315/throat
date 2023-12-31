<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold leading-tight
                    grow
                   text-xl text-gray-800 dark:text-gray-200">
                {{ __('Definitions') }}
            </h2>
            <p>
                <a href="{{ route('definitions.create') }}"
                   class="rounded-lg p-2 bg-blue-900 text-white
                        hover:bg-blue-100 hover:text-blue-900
                        transition ease-in-out duration-500"
                >Add New Definition</a>
            </p>
        </div>
    </x-slot>
    <h1 class="text-3xl
    p-6 pt-0 mb-4
    text-green-600
    bg-stone-200
    dark:text-green-200 dark:bg-stone-800">Definitions</h1>
    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The Definition "{{ session()->get('created') }} was created successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The Definition "{{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif
    <table class="table w-full text-gray-900 dark:text-gray-200 ">
        <thead>
        <tr class="bg-stone-900 text-stone-300">
            <th class="p-2 text-left">Row</th>
            <th class="p-1 px-2 text-left">Word</th>
            <th class="p-1 px-2 text-left">Word Type</th>
{{--            <th class="p-1 px-2 text-left">Rating</th>--}}
            <th class="p-1 px-2 text-left">Definition</th>
            <th class="p-2 text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @php $index = 1; @endphp
        @foreach($definitions as $definition)
            <tr>
                <td class="p-2 px-2">{{$loop->index + 1}}</td>

                <td class="p-2 px-2">
                    {{ Str::limit(optional($definition->word)->word, 7) }}
                </td>
                <td class="p-2 px-2">{{ optional(optional($definition->word)->wordType)->name }}</td>


{{--                <td class="p-2 px-2">--}}
{{--                    {{ optional($definition->ratings->first()->rating)->stars }}--}}
{{--                </td>--}}

{{--                <td class="p-2 px-2">--}}
{{--                    @foreach($definition->word->definitions as $def)--}}
{{--                        {{ Str::limit($def->definition, 10) }}<br>--}}
{{--                    @endforeach--}}
{{--                </td>--}}

                <td class="p-2 px-2">
                    {{ Str::limit($definition->definition, 50) }}
                </td>

                <td class="p-2 text-right">
                    <a href="{{route('definitions.show',$definition)}}"
                       class="text-center p-2 grow rounded-l-md
               bg-green-500 text-white dark:bg-green-800
                hover:bg-green-900 dark:hover:bg-green-500
                transition ease-in-out
                duration-350">            <i class="fa fa-eye" ></i>
                        <span class="sr-only">Show</span></a>
                    <a href="{{route('definitions.add',$definition)}}"
                       class="text-center p-2 grow
               bg-green-500 text-white dark:bg-blue-800
                hover:bg-blue-900 dark:hover:bg-blue-500
                transition ease-in-out
                duration-350">            <i class="fa fa-plus" ></i>
                        <span class="sr-only">Add</span></a>

                    <a href="{{route('definitions.edit',['definition'=>$definition])}}"
                       class="text-center p-2 grow
               bg-orange-500 text-white dark:bg-orange-800
                hover:bg-orange-900 dark:hover:bg-orange-500
                transition ease-in-out
                duration-350">            <i class="fa fa-edit" ></i>
                        <span class="sr-only">Edit</span></a>

                    <a href="{{route('definitions.delete',['definition'=>$definition])}}"
                       class="text-right p-2 grow rounded-r-md
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
            <td colspan="6" class="p-1">
                {{ $definitions->links() }}
            </td>
        </tr>
        </tfoot>
    </table>
</x-app-layout>
