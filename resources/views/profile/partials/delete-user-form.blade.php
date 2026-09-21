<section>
    <header>
        <h2 class="text-lg font-semibold text-label">{{ __('profile.delete_account') }}</h2>
        <p class="mt-1 text-sm text-label-2">{{ __('profile.delete_description') }}</p>
    </header>

    <div class="mt-6 flex justify-end">
        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('profile.delete_account') }}
        </x-danger-button>
    </div>

    <x-modal
        name="confirm-user-deletion"
        labelledby="confirm-user-deletion-title"
        :show="$errors->userDeletion->isNotEmpty()"
        maxWidth="lg"
        focusable
    >
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 id="confirm-user-deletion-title" class="text-lg font-semibold text-label">
                {{ __('profile.delete_confirm_title') }}
            </h2>
            <p class="mt-1 text-sm text-label-2">{{ __('profile.delete_confirm_description') }}</p>

            <div class="mt-6">
                <x-input-label for="delete_user_password" :value="__('fields.password')" />
                <x-text-input
                    id="delete_user_password"
                    name="password"
                    type="password"
                    class="mt-1.5 w-full"
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('common.cancel') }}</x-secondary-button>
                <x-danger-button>{{ __('profile.delete_account') }}</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
