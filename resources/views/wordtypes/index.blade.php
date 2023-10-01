<x-guest-layout>

    <h1 class="p-6 pt-0 mb-4
               text-green-500 text-3xl dark:text-green-200
               bg-stone-200 dark:bg-stone-800
               ">Word Types</h1>

    <table class="table w-full">
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
            <td class="p-1 flex flex-row gap-2 text-right">
                <a href="{{ route('wordtypes.show',['wordType'=>$wordType]) }}"
                   class="p-1 py-0  rounded-md
                          border border-green-700
                          hover:border-green-100 hover:bg-green-700 hover:text-white
                          transition ease-in-out duration-350  ">
                    View
                </a>
                Edit
                Delete
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

</x-guest-layout>
