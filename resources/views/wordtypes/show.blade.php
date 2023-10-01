<x-guest-layout>
    <h2 class="p-6 pt-0 mb-4
               text-green-500 text-3xl dark:text-green-200
               bg-stone-200 dark:bg-stone-800
               ">wordTypes</h2>

    <h3>Word Type #{{$wordType->id}} Details</h3>

    <section class="flex flex-col gap-2">
        <p class="text-stone-400 ">Name</p>
        <p class="pl-6">{{ $wordType->name }}</p>
        <p class="text-stone-400">Stars</p>
        <p class="pl-6">{{ $wordType->stars }}</p>
        <p class="w-full text-right">
            <a href="{{ route('wordtypes.index') }}">
            Back
            </a>
            Edit
            Delete
        </p>
    </section>

</x-guest-layout>
