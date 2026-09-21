@props(['name', 'size' => 'md'])

@php
    $initials = collect(preg_split('/\s+/u', trim($name)))
        ->filter()
        ->take(2)
        ->map(fn (string $word): string => mb_strtoupper(mb_substr($word, 0, 1)))
        ->implode('');

    $sizeClasses = match ($size) {
        'sm' => 'h-8 w-8 text-xs',
        'lg' => 'h-14 w-14 text-lg',
        default => 'h-9 w-9 text-sm',
    };
@endphp

<span
    aria-hidden="true"
    {{ $attributes->merge(['class' => "inline-flex shrink-0 select-none items-center justify-center rounded-full bg-accent/10 font-semibold text-accent {$sizeClasses}"]) }}
>{{ $initials }}</span>
