<nav class="border-b border-separator bg-surface [view-transition-name:site-nav]">
    <div class="mx-auto flex h-14 max-w-7xl items-center gap-2 px-4 sm:gap-6 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}" class="shrink-0 rounded-lg">
            <x-application-logo class="h-8 w-auto fill-current text-label" />
            <span class="sr-only">{{ config('app.name') }}</span>
        </a>

        <div class="-my-1 flex flex-1 items-center gap-1 overflow-x-auto py-1">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('menu.dashboard') }}
            </x-nav-link>

            @can('viewAny', App\Models\User::class)
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    {{ __('menu.users') }}
                </x-nav-link>
            @endcan
        </div>

        <x-dropdown align="right" width="w-64" content-classes="bg-surface">
            <x-slot name="trigger">
                <button
                    type="button"
                    aria-haspopup="menu"
                    :aria-expanded="open"
                    class="-me-2 inline-flex min-h-11 items-center gap-2 rounded-lg px-2 text-sm font-medium text-label-2 transition-colors hover:bg-label/5 hover:text-label motion-reduce:transition-none sm:min-h-9"
                >
                    <x-avatar :name="Auth::user()->name" size="sm" />
                    <span class="hidden max-w-40 truncate sm:block">{{ Auth::user()->name }}</span>
                    <span class="sr-only sm:hidden">{{ __('menu.account') }}</span>
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="border-b border-separator px-4 py-3">
                    <div class="truncate text-sm font-semibold text-label">{{ Auth::user()->name }}</div>
                    <div class="truncate text-sm text-label-2">{{ Auth::user()->email }}</div>
                </div>

                <div class="py-1">
                    <x-dropdown-link :href="route('profile.edit')">{{ __('menu.profile') }}</x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-button>{{ __('menu.logout') }}</x-dropdown-button>
                    </form>
                </div>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
