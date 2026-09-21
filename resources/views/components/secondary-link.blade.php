<a {{ $attributes->merge(['class' => 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-separator bg-surface px-4 text-sm font-semibold text-label shadow-sm transition-colors hover:bg-label/5 active:bg-label/10 motion-reduce:transition-none sm:min-h-9']) }}>
    {{ $slot }}
</a>
