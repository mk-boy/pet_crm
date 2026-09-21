<x-guest-layout>
    <x-slot:title>{{ __('auth.reset_password_title') }}</x-slot:title>

    <h1 class="text-xl font-semibold tracking-tight text-label">{{ __('auth.reset_password_title') }}</h1>

    <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}" />

        <div>
            <x-input-label for="email" :value="__('fields.email')" />
            <x-text-input
                id="email"
                class="mt-1.5 w-full"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
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

        <div class="flex justify-end">
            <x-primary-button>{{ __('auth.reset_password') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
