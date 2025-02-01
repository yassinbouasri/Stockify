<x-app-layout>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            [x-cloak] { display: none !important; }
        </style>

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stock Products') }}
        </h2>
    </x-slot>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            {{ $slot }}
        </div>
    </main>

    </body>
    </html>
</x-app-layout>
