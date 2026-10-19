@props(['name', 'legend', 'options' => [], 'selected' => [], 'messages' => []])

@php
    $selected = array_map('intval', (array) $selected);
    $errorId = $name . '-error';
@endphp

<fieldset {{ $attributes }} @if ($messages) aria-describedby="{{ $errorId }}" aria-invalid="true" @endif>
    <legend class="text-sm font-medium text-label">{{ $legend }}</legend>

    <div class="mt-1.5 flex flex-wrap gap-2">
        @foreach ($options as $value => $label)
            <label
                class="inline-flex h-11 cursor-pointer select-none items-center gap-2 rounded-full border border-field bg-surface px-4 text-base text-label shadow-sm transition-colors hover:bg-label/5 motion-reduce:transition-none has-[:checked]:border-accent has-[:checked]:bg-accent/10 has-[:focus-visible]:ring-2 has-[:focus-visible]:ring-accent sm:h-9 sm:text-sm"
            >
                <input
                    type="checkbox"
                    name="{{ $name }}[]"
                    value="{{ $value }}"
                    class="size-4 rounded border-field bg-surface text-accent focus:ring-0 focus:ring-offset-0 focus-visible:outline-none"
                    @checked(in_array((int) $value, $selected, true))
                />
                <span>{{ $label }}</span>
            </label>
        @endforeach
    </div>

    <x-input-error id="{{ $errorId }}" class="mt-2" :messages="$messages" />
</fieldset>
