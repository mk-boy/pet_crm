<x-app-layout>
    <x-slot:title>{{ __('menu.users_edit') }}</x-slot:title>

    <x-slot name="header">
        <h1 class="text-2xl font-semibold tracking-tight text-label">{{ __('menu.users_edit') }}</h1>
    </x-slot>

    <x-card class="max-w-xl">
        <form method="post" action="{{ route('users.update', $user->id) }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('fields.name')" />
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1.5 w-full"
                    :value="$user->name"
                    required
                    autofocus
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
                    :value="$user->email"
                    placeholder="name@example.com"
                    required
                    autocomplete="off"
                />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="password" :value="__('fields.password')" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1.5 w-full"
                    autocomplete="new-password"
                />
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
            </div>

            <div>
                <x-input-label for="role" :value="__('fields.role')" />
                <x-select-input id="role" name="role_id" class="mt-1.5 w-full" required>
                    @foreach ($roles as $role_id => $role_name)
                        <option value="{{ $role_id }}" @selected($user->role_id === $role_id)>{{ $role_name }}</option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <x-secondary-link :href="route('users.index')">{{ __('common.cancel') }}</x-secondary-link>
                <x-primary-button>{{ __('common.save_and_close') }}</x-primary-button>
            </div>
        </form>
    </x-card>
</x-app-layout>
