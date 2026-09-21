@if ($paginator->hasPages())
    <nav aria-label="{{ __('pagination.navigation') }}">
        {{-- Компактная ширина: только «Назад» и «Вперёд» --}}
        <div class="flex items-center justify-between gap-2 sm:hidden">
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
        </div>

        <div class="hidden items-center justify-between gap-4 sm:flex">
            <p class="text-sm tabular-nums text-label-2">
                {{ __('pagination.summary', ['first' => $paginator->firstItem() ?? 0, 'last' => $paginator->lastItem() ?? 0, 'total' => $paginator->total()]) }}
            </p>

            <div class="flex items-center gap-1">
                @if ($paginator->onFirstPage())
                    <span
                        aria-disabled="true"
                        aria-label="{{ __('pagination.previous') }}"
                        class="inline-flex h-9 min-w-9 cursor-not-allowed items-center justify-center rounded-lg px-2 text-sm tabular-nums text-label-2 opacity-50"
                    >
                        <svg class="h-5 w-5 rtl:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @else
                    <a
                        href="{{ $paginator->previousPageUrl() }}"
                        rel="prev"
                        aria-label="{{ __('pagination.previous') }}"
                        class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg px-2 text-sm font-medium tabular-nums text-label transition-colors hover:bg-label/5 active:bg-label/10 motion-reduce:transition-none"
                    >
                        <svg class="h-5 w-5 rtl:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span
                            aria-hidden="true"
                            class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg px-2 text-sm tabular-nums text-label-2"
                        >{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    aria-current="page"
                                    class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg bg-accent/10 px-2 text-sm font-semibold tabular-nums text-accent"
                                >{{ $page }}</span>
                            @else
                                <a
                                    href="{{ $url }}"
                                    aria-label="{{ __('pagination.go_to_page', ['page' => $page]) }}"
                                    class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg px-2 text-sm font-medium tabular-nums text-label transition-colors hover:bg-label/5 active:bg-label/10 motion-reduce:transition-none"
                                >
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a
                        href="{{ $paginator->nextPageUrl() }}"
                        rel="next"
                        aria-label="{{ __('pagination.next') }}"
                        class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg px-2 text-sm font-medium tabular-nums text-label transition-colors hover:bg-label/5 active:bg-label/10 motion-reduce:transition-none"
                    >
                        <svg class="h-5 w-5 rtl:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </a>
                @else
                    <span
                        aria-disabled="true"
                        aria-label="{{ __('pagination.next') }}"
                        class="inline-flex h-9 min-w-9 cursor-not-allowed items-center justify-center rounded-lg px-2 text-sm tabular-nums text-label-2 opacity-50"
                    >
                        <svg class="h-5 w-5 rtl:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
