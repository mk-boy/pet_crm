@if ($paginator->hasPages())
    <nav aria-label="{{ __('pagination.navigation') }}" class="flex items-center justify-between gap-2">
        @if ($paginator->onFirstPage())
            <span
                aria-disabled="true"
                class="inline-flex min-h-11 cursor-not-allowed items-center rounded-lg border border-separator bg-surface px-4 text-sm font-semibold text-label-2 opacity-50 shadow-sm"
            >{{ __('pagination.previous') }}</span>
        @else
            <a
                href="{{ $paginator->previousPageUrl() }}"
                rel="prev"
                class="inline-flex min-h-11 items-center rounded-lg border border-separator bg-surface px-4 text-sm font-semibold text-label shadow-sm transition-colors hover:bg-label/5 active:bg-label/10 motion-reduce:transition-none"
            >{{ __('pagination.previous') }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a
                href="{{ $paginator->nextPageUrl() }}"
                rel="next"
                class="inline-flex min-h-11 items-center rounded-lg border border-separator bg-surface px-4 text-sm font-semibold text-label shadow-sm transition-colors hover:bg-label/5 active:bg-label/10 motion-reduce:transition-none"
            >{{ __('pagination.next') }}</a>
        @else
            <span
                aria-disabled="true"
                class="inline-flex min-h-11 cursor-not-allowed items-center rounded-lg border border-separator bg-surface px-4 text-sm font-semibold text-label-2 opacity-50 shadow-sm"
            >{{ __('pagination.next') }}</span>
        @endif
    </nav>
@endif
