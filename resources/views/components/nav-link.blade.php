@props(['active' => false])

@php
    $classes = $active
        ? 'inline-flex min-h-11 shrink-0 items-center rounded-lg bg-accent/10 px-3 text-sm font-semibold text-accent sm:min-h-9'
        : 'inline-flex min-h-11 shrink-0 items-center rounded-lg px-3 text-sm font-medium text-label-2 transition-colors hover:bg-label/5 hover:text-label motion-reduce:transition-none sm:min-h-9';
@endphp

<a @if ($active) aria-current="page" @endif {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
