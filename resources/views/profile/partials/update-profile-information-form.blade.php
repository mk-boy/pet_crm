<section>
    <header>
        <h2 class="text-lg font-semibold text-label">{{ __('profile.information') }}</h2>
        <p class="mt-1 text-sm text-label-2">{{ __('profile.information_description') }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('fields.name')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1.5 w-full"
                :value="old('name', $user->name)"
                required
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('fields.email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1.5 w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="mt-2 text-sm text-label">
                    {{ __('profile.email_unverified') }}

                    <button form="send-verification" class="rounded font-medium text-accent hover:underline">
                        {{ __('profile.resend_verification_link') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p role="status" class="mt-2 text-sm font-medium text-success">
                        {{ __('profile.verification_sent') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button>{{ __('common.save') }}</x-primary-button>
        </div>
    </form>
</section>
