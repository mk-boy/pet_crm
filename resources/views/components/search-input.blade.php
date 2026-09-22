@props(['action', 'label', 'name' => 'search_query', 'placeholder' => null])

@php
    $isFiltered = request()->filled($name);
@endphp

<form method="get" action="{{ $action }}" role="search" {{ $attributes->merge(['class' => 'relative']) }}>
    <label for="{{ $name }}" class="sr-only">{{ $label }}</label>

    <x-icons.search class="pointer-events-none absolute start-3 top-1/2 -translate-y-1/2 text-label-2" />

    <x-text-input
        :id="$name"
        :name="$name"
        type="search"
        :value="request($name)"
        :placeholder="$placeholder"
        autocomplete="off"
        @class([
            'h-11 w-full ps-9 sm:h-9',
            /* Свой сброс вместо встроенного крестика WebKit: он есть не во всех браузерах и не сбрасывает результаты. */
            'pe-12 [&::-webkit-search-cancel-button]:appearance-none sm:pe-10' => $isFiltered,
        ])
    />

    @if ($isFiltered)
        <a
            href="{{ $action }}"
            class="absolute end-1 top-1/2 inline-flex size-9 -translate-y-1/2 items-center justify-center rounded-lg text-label-2 transition-colors hover:bg-label/5 hover:text-label active:bg-label/10 motion-reduce:transition-none sm:size-7"
            aria-label="{{ __('common.clear') }}"
            title="{{ __('common.clear') }}"
        >
            <x-icons.close />
        </a>
    @endif
</form>
