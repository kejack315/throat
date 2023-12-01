<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwindcss -->

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
    <style>
        /* 自定义图标颜色类 */
        .custom-yellow {
            color: yellow;
        }

        .custom-orange {
            color: orange;
        }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="w-4/5 mt-6 p-4 mx-auto overflow-hidden
                     bg-white dark:bg-gray-800
                     rounded sm:rounded-lg shadow-md ">
        {{ $slot }}
    </main>
    <!-- footer -->
    <footer class="bg-gray-200 dark:bg-gray-700 p-4 text-center bottom-0 left-0 right-0 fixed z-50">
        &copy; {{ date('Y') }} ZKE LARAVEL |
        <a href="/home" class="bg-gray-200 dark:bg-gray-700">Home</a> |
        <a href="/privacy" class="bg-gray-200 dark:bg-gray-700">Privacy</a> |
        <a href="/contact" class="bg-gray-200 dark:bg-gray-700">Contact Us</a> |
        <a href="/color" class="bg-gray-200 dark:bg-gray-700">Color</a> |
        <a href="/icons" class="bg-gray-200 dark:bg-gray-700">Icons</a> |
        <a href="/terms-and-conditions" class="bg-gray-200 dark:bg-gray-700">Terms-and-conditions</a>
    </footer>


</div>
</body>
</html>
