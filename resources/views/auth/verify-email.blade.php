<x-guest-layout>
    <x-slot:title>{{ __('auth.verify_email_title') }}</x-slot:title>

    <h1 class="text-xl font-semibold tracking-tight text-label">{{ __('auth.verify_email_title') }}</h1>
    <p class="mt-2 text-sm text-label-2">{{ __('auth.verify_email_intro') }}</p>

    @if (session('status') == 'verification-link-sent')
        <x-auth-session-status class="mt-4" :status="__('auth.verification_link_sent')" />
    @endif

    <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="rounded text-sm font-medium text-accent hover:underline">
                {{ __('menu.logout') }}
            </button>
        </form>

        <form method="POST" action="{{ route('verification.send') }}" class="ms-auto">
            @csrf

            <x-primary-button>{{ __('auth.resend_verification') }}</x-primary-button>
        </form>
    </div>
</x-guest-layout>
