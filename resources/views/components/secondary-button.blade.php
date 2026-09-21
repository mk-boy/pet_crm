<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg px-4 text-sm font-semibold transition-colors motion-reduce:transition-none disabled:pointer-events-none disabled:opacity-50 sm:min-h-9 border border-separator bg-surface text-label shadow-sm hover:bg-label/5 active:bg-label/10']) }}>
    {{ $slot }}
</button>
