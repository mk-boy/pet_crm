<section>
    <header>
        <h2 class="text-lg font-semibold text-label">{{ __('profile.update_password') }}</h2>
        <p class="mt-1 text-sm text-label-2">{{ __('profile.update_password_description') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('fields.current_password')" />
            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1.5 w-full"
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('fields.new_password')" />
            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1.5 w-full"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('fields.password_confirmation')" />
            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1.5 w-full"
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button>{{ __('common.save') }}</x-primary-button>
        </div>
    </form>
</section>
