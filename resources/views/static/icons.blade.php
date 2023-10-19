<x-app-layout>

    <x-slot name="header" class="flex-col gap-2">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Icons used on site') }}
        </h2>
        <p class="text-lead mt-4"><a href="https://fontawesome.com/search?o=r&m=free"
                                     class="text-slate-900 border border-x-0 border-t-0 pb-1 border-slate-900 hover:text-blue-500 hover:border-sky-500 ">FontAwesome
                (Free)</a> icons used are shown below.</p>
    </x-slot>

    <div class="grid grid-cols-3 gap-2 text-lg">

        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-circle"></i> fa-solid
            fa-circle</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-xmark"></i> fa-solid
            fa-xmark</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-pause"></i> fa-solid
            fa-pause</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-arrow-down-long"></i>
            fa-solid fa-arrow-down-long</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-arrow-down"></i> fa-solid
            fa-arrow-down</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-left-right"></i> fa-solid
            fa-left-right</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-arrow-up"></i> fa-solid
            fa-arrow-up</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-arrow-up-long"></i> fa-solid
            fa-arrow-up-long</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa-solid fa-triangle-exclamation"></i>
            fa-solid fa-triangle-exclamation</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa fa-solid fa-ghost"></i> fa fa-solid
            fa-ghost</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa fa-solid fa-lemon"></i> fa fa-solid
            fa-lemon</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa fa-solid fa-poo"></i> fa fa-solid
            fa-poo</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa fa-solid fa-star"></i> fa fa-solid
            fa-star</p>
        <p class="rounded flex flex-row gap-4 text-neutral-500 border p-1 "><i
                class="rounded h-10 w-12 text-neutral-50 bg-neutral-950 p-2 text-center fa fa-solid fa-pepper-hot"></i> fa
            fa-solid fa-pepper-hot</p>

        <p class="rounded text-neutral-500 border p-1 text-sm text-neutral-500 text-center pt-4">More icons added as
            required...</p>
    </div>


</x-guest-layout>
