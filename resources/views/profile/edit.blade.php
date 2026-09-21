<x-app-layout>
    <x-slot:title>{{ __('menu.profile') }}</x-slot:title>

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <x-avatar :name="$user->name" size="lg" />
            <div class="min-w-0">
                <h1 class="text-2xl font-semibold tracking-tight text-label">{{ __('menu.profile') }}</h1>
                <p class="truncate text-sm text-label-2">{{ $user->email }}</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl space-y-6">
        <x-card>
            @include('profile.partials.update-profile-information-form')
        </x-card>

        <x-card>
            @include('profile.partials.update-password-form')
        </x-card>

        <x-card>
            @include('profile.partials.delete-user-form')
        </x-card>
    </div>
</x-app-layout>
