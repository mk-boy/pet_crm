<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('menu.users_create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <form method="post" action="{{ route('users.store') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('fields.name')" />
                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-2">
                    <x-input-label for="email" :value="__('fields.email')" />
                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autocomplete="username"
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div class="mt-2">
                    <x-input-label for="password" :value="__('fields.password')" />

                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-2">
                    <x-input-label for="role" :value="__('fields.role')" />

                    <x-select-input id="role" class="mt-1 block w-full" name="role_id" required>
                        @foreach ($roles as $role_id => $role_name)
                            <option value="{{ $role_id }}">{{ $role_name }}</option>
                        @endforeach
                    </x-select-input>
                </div>

                <div class="mt-5">
                    <x-primary-button>{{ __('common.save') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
