<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('menu.users') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <x-primary-link :href="route('users.create')">{{ __('users.create') }}</x-primary-link>
            <x-table>
                <x-slot:head>
                    <th>{{ __('fields.name') }}</th>
                    <th>{{ __('fields.email') }}</th>
                    <th>{{ __('fields.role') }}</th>
                </x-slot:head>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role?->role_name }}</td>
                    </tr>
                @endforeach
            </x-table>
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
