<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ isset($title) ? $title . ' · ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen flex-col items-center px-4 pt-10 sm:justify-center sm:pt-0">
        <a href="/" class="rounded-lg">
            <x-application-logo class="h-14 w-14 fill-current text-label" />
            <span class="sr-only">{{ config('app.name') }}</span>
        </a>

        <div class="mt-8 w-full rounded-2xl bg-surface px-6 py-8 shadow-sm ring-1 ring-separator sm:max-w-md sm:px-8">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
