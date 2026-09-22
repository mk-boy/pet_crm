@props(['label', 'name' => 'search_query', 'placeholder' => null])

<div {{ $attributes->merge(['class' => 'relative']) }}>
    <label for="{{ $name }}" class="sr-only">{{ $label }}</label>

    <x-icons.search class="pointer-events-none absolute start-3 top-1/2 -translate-y-1/2 text-label-2" />

    <x-text-input
        :id="$name"
        :name="$name"
        type="search"
        :value="request($name)"
        :placeholder="$placeholder"
        autocomplete="off"
        class="h-11 w-full ps-9 sm:h-9"
    />
</div>
