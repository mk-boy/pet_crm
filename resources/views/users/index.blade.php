<x-app-layout>
    <x-slot:title>{{ __('menu.users') }}</x-slot:title>

    <x-slot name="header">
        <h1 class="text-2xl font-semibold tracking-tight text-label">{{ __('menu.users') }}</h1>

        <x-primary-link :href="route('users.create')">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
            </svg>
            {{ __('users.create') }}
        </x-primary-link>
    </x-slot>

    @if ($users->isEmpty())
        <x-card class="text-center">
            <h2 class="text-lg font-semibold text-label">{{ __('users.empty') }}</h2>
            <p class="mt-1 text-sm text-label-2">{{ __('users.empty_hint') }}</p>
        </x-card>
    @else
        <x-table>
            <x-slot:head>
                <th scope="col">{{ __('fields.name') }}</th>
                <th scope="col" class="hidden sm:table-cell">{{ __('fields.email') }}</th>
                <th scope="col">{{ __('fields.role') }}</th>
                <th scope="col"><span class="sr-only">{{ __('fields.actions') }}</span></th>
            </x-slot:head>

            @foreach ($users as $user)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <x-avatar :name="$user->name" />
                            <div class="min-w-0">
                                <div class="truncate font-medium">{{ $user->name }}</div>
                                <div class="truncate text-label-2 sm:hidden">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="hidden text-label-2 sm:table-cell">{{ $user->email }}</td>
                    <td>
                        @if ($user->role)
                            <span class="inline-flex rounded-full bg-label/5 px-2.5 py-0.5 text-sm font-medium">
                                {{ $user->role->role_name }}
                            </span>
                        @else
                            <span class="text-label-2">{{ __('users.no_role') }}</span>
                        @endif
                    </td>
                    <td class="w-px text-end">
                        @can('update', $user)
                            <a
                                href="{{ route('users.edit', $user) }}"
                                class="inline-flex size-11 items-center justify-center rounded-lg text-label-2 transition-colors hover:bg-label/5 hover:text-label active:bg-label/10 motion-reduce:transition-none sm:size-9"
                                aria-label="{{ __('users.edit', ['name' => $user->name]) }}"
                                title="{{ __('users.edit', ['name' => $user->name]) }}"
                            >
                                <x-icons.pencil />
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </x-table>

        <div class="mt-4">{{ $users->links() }}</div>
    @endif
</x-app-layout>
