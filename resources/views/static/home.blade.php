<x-app-layout>
    <!-- 页眉部分 -->
    <x-slot name="header">
        <nav class="text-white py-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('static.home') }}" class="hover:text-teal-700">Home</a>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('static.privacy') }}" class="hover:text-teal-700">About</a></li>
                    <li><a href="{{ route('static.contact') }}" class="hover:text-teal-700">Contact</a></li>
                    <li><a href="/color" class="hover:text-teal-700">Color</a></li>
                    <li><a href="/icons" class="hover:text-teal-700">Icons</a></li>
                    <li><a href="/terms-and-conditions" class="hover:text-teal-700">Terms-and-conditions</a></li>
                </ul>
            </div>
        </nav>
    </x-slot>

    <!-- 主要内容部分 -->
    <div class="container mx-auto mt-8">
        <h1 class="text-4xl font-semibold text-teal-700 mb-4">Welcome to {{ env('APP_NAME') }}</h1>
        <p class="text-gray-600 mb-6">Empty</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-2xl font-semibold text-teal-700 mb-2">Our Services</h2>
                <ul class="list-disc pl-4">
                    <li>Service 1</li>
                    <li>Service 2</li>
                    <li>Service 3</li>
                </ul>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-teal-700 mb-2">Latest News</h2>
                <ul>
                    <li>
                        <a href="#" class="text-teal-700 hover:underline">News 1</a>
                        <p class="text-gray-600">Empty</p>
                    </li>
                    <li>
                        <a href="#" class="text-teal-700 hover:underline">News 2</a>
                        <p class="text-gray-600">Empty</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 页脚部分 -->
    <x-slot name="footer">
        <footer class="bg-gray-900 text-white py-4">
            <div class="container mx-auto text-center">
                &copy; {{ date('Y') }} {{ env('APP_NAME') }}
            </div>
        </footer>
    </x-slot>
</x-app-layout>
