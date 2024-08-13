<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/auth.css', 'resources/js/auth.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased min-h-screen text-color-6c757d bg-color-85a7d8 flex items-center justify-center">
        <div class="w-[400px] bg-white p-10 rounded">
            <a href="{{ route('login') }}"><x-application-logo class="mx-auto"/></a>
            <div>
                {{ $slot }}
            </div>
        </div>
        @persist('notification')
        <x-notification />
        @endpersist
        @stack('scripts')
    </body>
</html>
