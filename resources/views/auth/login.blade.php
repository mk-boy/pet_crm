<x-guest-layout>
    <x-slot:title>{{ __('auth.login_title') }}</x-slot:title>

    <h1 class="text-xl font-semibold tracking-tight text-label">{{ __('auth.login_title') }}</h1>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
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

        <div>
            <x-input-label for="password" :value="__('fields.password')" />
            <x-text-input
                id="password"
                class="mt-1.5 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex min-h-11 items-center gap-2 sm:min-h-0">
            <input
                id="remember_me"
                type="checkbox"
                class="h-4 w-4 rounded border-field bg-surface text-accent focus:ring-accent"
                name="remember"
            />
            <span class="text-sm text-label">{{ __('auth.remember_me') }}</span>
        </label>

        <div class="flex flex-wrap items-center justify-between gap-4">
            @if (Route::has('password.request'))
                <a
                    class="rounded text-sm font-medium text-accent hover:underline"
                    href="{{ route('password.request') }}"
                >{{ __('auth.forgot_password') }}</a>
            @endif

            <x-primary-button class="ms-auto">{{ __('auth.login') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
