@if (session('toast'))
    <div
        x-data="{
            show: true,
            timer: null,
            start() {
                this.timer = setTimeout(() => (this.show = false), 5000);
            },
            stop() {
                clearTimeout(this.timer);
            },
        }"
        x-init="start()"
        x-show="show"
        @mouseenter="stop()"
        @mouseleave="start()"
        @focusin="stop()"
        @focusout="start()"
        x-transition:enter="transition ease-out duration-300 motion-reduce:transition-none"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 motion-reduce:transition-none"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        role="status"
        class="fixed inset-x-4 bottom-4 z-50 flex items-center gap-3 rounded-xl border border-separator bg-surface py-2 pe-1 ps-3 shadow-xl sm:inset-x-auto sm:bottom-5 sm:right-5 sm:w-96"
    >
        <span
            class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-success/15 text-success"
            aria-hidden="true"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
        </span>

        <p class="flex-1 text-sm font-medium text-label">{{ session('toast') }}</p>

        <button
            type="button"
            @click="show = false"
            aria-label="{{ __('common.close') }}"
            class="shrink-0 rounded-lg p-3 text-label-2 transition-colors hover:bg-label/5 hover:text-label motion-reduce:transition-none"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
