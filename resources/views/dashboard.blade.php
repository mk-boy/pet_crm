<x-app-layout>
    <x-slot:title>{{ __('menu.dashboard') }}</x-slot:title>

    <x-slot name="header">
        <h1 class="text-2xl font-semibold tracking-tight text-label">{{ __('menu.dashboard') }}</h1>
    </x-slot>

    <x-card>
        <p class="text-sm text-label">{{ __('dashboard.logged_in') }}</p>

        @if (auth()->user()->role?->role_name === 'guest')
            <b><p class="mt-2 text-sm text-label">{{ __('dashboard.guest_message') }}</p></b>
        @endif
    </x-card>
</x-app-layout>
