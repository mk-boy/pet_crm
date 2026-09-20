@if (session('toast'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => (show = false), 4000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2 md:translate-y-0 md:translate-x-2"
        x-transition:enter-end="opacity-100 transform translate-y-0 md:translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2 md:translate-y-0 md:translate-x-2"
        role="status"
        class="fixed bottom-5 right-5 z-50 flex w-full max-w-sm items-start gap-3 overflow-hidden rounded-lg border border-l-4 border-gray-200 border-l-green-500 bg-white px-4 py-3 shadow-xl ring-1 ring-black/5 dark:border-gray-700 dark:border-l-green-400 dark:bg-gray-800 dark:ring-white/10"
    >
        <svg class="mt-0.5 h-5 w-5 shrink-0 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>

        <p class="flex-1 text-sm font-medium text-gray-900 dark:text-gray-100">{{ session('toast') }}</p>

        <button
            type="button"
            @click="show = false"
            aria-label="{{ __('common.close') }}"
            class="shrink-0 rounded text-gray-400 transition hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:hover:text-gray-300"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
