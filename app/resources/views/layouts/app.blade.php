<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @class(['invoice-page' => request()->routeIs('invoices.show') || request()->routeIs('invoicing.invoices.show')])
>
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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased text-color-343a40 bg-color-f5f6f8">
        <div class="min-h-screen p-4 ml-20 xl:ml-[300px] shadow-app-1">
            <div class="fixed top-4 left-4 bottom-4 w-20 min-w-20 xl:w-[300px] xl:min-w-[300px] bg-white rounded-md">
                <a class="flex items-center h-[70px] xl:h-auto" href="{{ route('dashboard') }}">
                    <x-application-logo class="mt-4 mx-auto hidden xl:inline" />
                    <x-application-logo name="logo-icon.png" class="mx-auto w-10 xl:hidden" />
                </a>
                <x-side-navigation />
            </div>
            <div class="ml-4">
                <livewire:components.top-bar />
                @if(session('alert_msg'))
                    <div class="inline-flex items-center gap-4 mt-4 py-4 px-8 text-white font-semibold bg-orange-500 rounded-sm">
                        <x-icon name="info" class="w-4 h-4 fill-color-ffffff" />
                        <span>{{ session('alert_msg') }}</span>
                    </div>
                @endif
                {{ $slot }}
            </div>
        </div>
        @persist('notification')
        <x-notification />
        @endpersist
        @stack('scripts')
        @persist('wire-elements-modal')
        @livewire('wire-elements-modal')
        @endpersist
        <livewire:components.user-notifications-sidebar />
    </body>
</html>
