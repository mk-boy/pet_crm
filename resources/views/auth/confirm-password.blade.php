<x-guest-layout>
    <x-slot:title>{{ __('auth.confirm_password_title') }}</x-slot:title>

    <h1 class="text-xl font-semibold tracking-tight text-label">{{ __('auth.confirm_password_title') }}</h1>
    <p class="mt-2 text-sm text-label-2">{{ __('auth.confirm_password_intro') }}</p>

    <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('fields.password')" />
            <x-text-input
                id="password"
                class="mt-1.5 w-full"
                type="password"
                name="password"
                required
                autofocus
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end">
            <x-primary-button>{{ __('common.confirm') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
