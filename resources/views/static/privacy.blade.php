<x-app-layout>
    <div class="flex flex-col gap-4">
        <h1 class="text-teal-700 text-2xl">
            Welcome to {{ env('APP_NAME') }}
        </h1>

        <p class="text-red-500">
            Privacy Policy Here
        </p>

        <ul class="flex flex-row gap-4 mt-6">
            <li><a class="bg-stone-300 rounded-full p-2"
                   href="{{route('static.home')}}">
                    Home
                </a></li>
            <li><a class="bg-stone-300 rounded-full p-2"
                   href="{{route('static.privacy')}}">
                    Privacy</a>
            </li>
            <li><a class="bg-stone-300 rounded-full p-2"
                   href="{{route('static.contact')}}">
                    Contact Us
                </a></li>
        </ul>
    </div>
</x-app-layout>
