<x-guest-layout>
    <x-slot:title>{{ __('auth.forgot_password_title') }}</x-slot:title>

    <h1 class="text-xl font-semibold tracking-tight text-label">{{ __('auth.forgot_password_title') }}</h1>
    <p class="mt-2 text-sm text-label-2">{{ __('auth.forgot_password_intro') }}</p>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-5">
        @csrf

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
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-end">
            <x-primary-button>{{ __('auth.email_reset_link') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
