<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row">
            <h2 class="font-semibold leading-tight
                    grow
                   text-xl text-gray-800 dark:text-gray-200">
                {{ __('Ratings') }}
            </h2>
            <p>
                <a href="{{ route('ratings.add') }}"
                   class="rounded-lg p-2 bg-blue-900 text-white
                        hover:bg-blue-100 hover:text-blue-900
                        transition ease-in-out duration-500"
                >Add New Rating</a>
            </p>
        </div>
    </x-slot>
    <h1 class="text-3xl
    p-6 pt-0 mb-4
    text-green-600
    bg-stone-200
    dark:text-green-200 dark:bg-stone-800">Ratings</h1>
    @if(session()->has('created'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-green-500 text-white rounded">
                <i class="text-xl fa fa-check-circle text-green-200 bg-green-800 rounded-full mr-4 p-2"></i>
                The rating "{{ session()->get('created') }} was created successfully.
            </p>
        </div>
    @endif
    @if(session()->has('updated'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-amber-500 text-white rounded">
                <i class="fa fa-check-circle text-amber-200 bg-amber-800 rounded-full mr-4 p-2"></i>
                The rating "{{ session()->get('updated') }} was updated successfully.
            </p>
        </div>
    @endif
    @if(session()->has('deleted'))
        <div class="w-full p-2 m-0 mb-6">
            <p class="w-full p-4 bg-purple-500 text-white rounded">
                <i class="fa fa-check-circle text-purple-200 bg-purple-800 rounded-full mr-4 p-2"></i>
                The rating "{{ session()->get('deleted') }} was deleted successfully.
            </p>
        </div>
    @endif
    <table class="table w-full text-gray-900 dark:text-gray-200 ">
        <thead>
        <tr class="bg-stone-900 text-stone-300">
            <th class="p-2 text-left">Row</th>
            <th class="p-1 px-2 text-left">Name</th>
            <th class="p-1 px-2 text-left">Stars</th>
            <th class="p-2 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ratings as $rating)
            <tr>
                <td class="p-2 px-2">{{$loop->index + 1}}</td>
                <td class="p-2 px-2">{{$rating->name}}</td>
                <td class="p-2 px-2">

{{--                    {{ $rating->icon }}--}}
                    @for($count=0; $count <= $rating->stars; $count++)
{{--                        <i class="fa fa-{{ $rating->icon }}"></i>--}}
                        @if ($rating->icon === 'lemon')
                            <i class="fa fa-lemon text-yellow-500"></i>
                        @elseif($rating->icon === 'star')
                            <i class="fa fa-star text-yellow-200"></i>
                        @elseif($rating->icon === 'splotch')
                            <i class="fa fa-splotch text-yellow-800"></i>
                        @elseif($rating->icon === 'poo')
                            <i class="fa fa-poo text-yellow-950"></i>
                        @elseif($rating->icon === 'cloud')
                            <i class="fa fa-cloud text-red-400"></i>
                        @elseif($rating->icon === 'thumbs up')
                            <i class="fa fa-thumbs-up text-gray-300"></i>
                        @elseif($rating->icon === 'thumbs down')
                            <i class="fa fa-thumbs-down text-green-700"></i>
                        @endif
                    @endfor
{{--                    @for($count = 1; $count <= $rating->stars; $count++)--}}
{{--                        <option value="star" @if(old('icon')??$rating->icon=='star') selected @endif>Star</option>--}}
{{--                        <i class="fa fa-{{$rating->icon}}"></i>--}}
{{--                    @endfor--}}

                </td>
                <td class="p-2">
                    <a href="{{route('ratings.show', $rating)}}"
                       class="text-center p-2 grow rounded-l-md
               bg-green-500 text-white dark:bg-green-800
                hover:bg-green-900 dark:hover:bg-green-500
                transition ease-in-out
                duration-350">            <i class="fa fa-eye" ></i>
                        <span class="sr-only">Show</span></a>
                    <a href="{{route('ratings.edit',['rating'=>$rating])}}"
                       class="text-center p-2 grow
               bg-orange-500 text-white dark:bg-orange-800
                hover:bg-orange-900 dark:hover:bg-orange-500
                transition ease-in-out
                duration-350">            <i class="fa fa-edit" ></i>
                        <span class="sr-only">Edit</span></a>
                    <a href="{{route('ratings.delete',['rating'=>$rating])}}"
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
            <td colspan="4" class="p-1">
                {{ $ratings->links() }}
            </td>
        </tr>
        </tfoot>

    </table>
</x-app-layout>
