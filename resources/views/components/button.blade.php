@props([
    'variant' => 'secondary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'label' => null,
])

@php
    $variantClasses = [
        'primary' => 'bg-accent text-on-accent hover:bg-accent/90 active:bg-accent/80',
        'secondary' => 'border border-separator bg-surface text-label shadow-sm hover:bg-label/5 active:bg-label/10',
        'danger' => 'bg-danger text-on-danger hover:bg-danger/90 active:bg-danger/80',
        'ghost' => 'text-label-2 hover:bg-label/5 hover:text-label active:bg-label/10',
        'ghost-danger' => 'text-label-2 hover:bg-danger/10 hover:text-danger active:bg-danger/15',
    ][$variant];

    $sizeClasses = [
        'md' => 'min-h-11 gap-2 px-4 text-sm font-semibold sm:min-h-9',
        'icon' => 'size-11 sm:size-9',
    ][$size];

    $classes = "inline-flex items-center justify-center rounded-lg transition-colors motion-reduce:transition-none disabled:pointer-events-none disabled:opacity-50 aria-disabled:pointer-events-none aria-disabled:opacity-50 {$sizeClasses} {$variantClasses}";

    $labelAttributes = $label ? ['aria-label' => $label, 'title' => $label] : [];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes, ...$labelAttributes]) }}> {{ $slot }} </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes, ...$labelAttributes]) }}>{{ $slot }}</button>
@endif
