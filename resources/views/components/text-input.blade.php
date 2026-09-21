@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'block rounded-lg border-field bg-surface text-base text-label shadow-sm placeholder:text-label-2 focus:border-accent focus:ring-accent disabled:cursor-not-allowed disabled:opacity-60 sm:text-sm']) }}
/>
