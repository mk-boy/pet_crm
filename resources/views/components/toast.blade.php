@if (session('status'))
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
        class="fixed bottom-5 right-5 z-50 flex w-full max-w-sm items-center justify-between rounded-lg border border-gray-700 bg-gray-900 px-4 py-3 text-white shadow-lg"
    >
        <div class="dynamic-text flex items-center text-sm font-medium">
            <span>{{ session('status') }}</span>
        </div>

        <button @click="show = false" class="ml-4 text-gray-400 transition hover:text-white">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
