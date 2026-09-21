<x-guest-layout>
    <x-slot:title>{{ __('auth.register') }}</x-slot:title>

    <h1 class="text-xl font-semibold tracking-tight text-label">{{ __('auth.register') }}</h1>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('fields.name')" />
            <x-text-input
                id="name"
                class="mt-1.5 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('fields.email')" />
            <x-text-input
                id="email"
                class="mt-1.5 w-full"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="name@example.com"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('fields.password')" />
            <x-text-input
                id="password"
                class="mt-1.5 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('fields.password_confirmation')" />
            <x-text-input
                id="password_confirmation"
                class="mt-1.5 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4">
            <a
                class="rounded text-sm font-medium text-accent hover:underline"
                href="{{ route('login') }}"
            >{{ __('auth.already_registered') }}</a>

            <x-primary-button class="ms-auto">{{ __('auth.register') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
