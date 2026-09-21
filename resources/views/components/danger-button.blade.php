<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex min-h-11 items-center justify-center gap-2 rounded-lg px-4 text-sm font-semibold transition-colors motion-reduce:transition-none disabled:pointer-events-none disabled:opacity-50 sm:min-h-9 bg-danger text-on-danger hover:bg-danger/90 active:bg-danger/80']) }}>
    {{ $slot }}
</button>
