<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ isset($title) ? $title . ' · ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased">
    @include('layouts.navigation')

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @isset($header)
            <header class="mb-6 flex flex-wrap items-center justify-between gap-4">{{ $header }}</header>
        @endisset

        {{ $slot }}
    </main>

    <x-toast />
</body>
</html>
