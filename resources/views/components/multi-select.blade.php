@props([
    'name',
    'label',
    'options' => [],
    'selected' => [],
    'messages' => [],
    'placeholder' => __('common.none_selected'),
    'searchThreshold' => 7,
])

@php
    $selected = array_map('intval', (array) $selected);
    $labelId = $name . '-label';
    $panelId = $name . '-panel';
    $errorId = $name . '-error';
    $isSearchable = count($options) > $searchThreshold;
@endphp

<div
    {{ $attributes->merge(['class' => 'relative']) }}
    x-data="{
        open: false,
        query: '',
        labels: @js(collect($options)->values()),
        selectedLabels: [],
        syncSelected() {
            this.selectedLabels = [...this.$refs.panel.querySelectorAll('input[type=checkbox]:checked')].map(
                (input) => input.dataset.label,
            )
        },
        toggle() {
            this.open ? this.close() : this.show()
        },
        show() {
            this.open = true
            this.$nextTick(() => (this.$refs.search ?? this.$refs.panel.querySelector('input'))?.focus())
        },
        close(returnFocus = false) {
            this.open = false
            this.query = ''
            if (returnFocus) this.$refs.trigger.focus()
        },
        matches(label) {
            return label.toLowerCase().includes(this.query.trim().toLowerCase())
        },
        get hasMatches() {
            return this.labels.some((label) => this.matches(label))
        },
    }"
    x-init="syncSelected()"
    @click.outside="close()"
    @focusin.window="if (open && ! $el.contains($event.target)) close()"
    @keydown.escape.prevent.stop="close(true)"
>
    <span id="{{ $labelId }}" class="block text-sm font-medium text-label">{{ $label }}</span>

    <button
        type="button"
        x-ref="trigger"
        @click="toggle()"
        :aria-expanded="open.toString()"
        aria-expanded="false"
        aria-controls="{{ $panelId }}"
        aria-labelledby="{{ $labelId }} {{ $name }}-summary"
        @if ($messages) aria-describedby="{{ $errorId }}" aria-invalid="true" @endif
        class="mt-1.5 flex h-11 w-full items-center gap-2 rounded-lg border border-field bg-surface pe-3 ps-3 text-start text-base text-label shadow-sm focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent sm:h-9 sm:text-sm"
    >
        <span id="{{ $name }}-summary" class="min-w-0 flex-1 truncate">
            <span x-show="selectedLabels.length" x-text="selectedLabels.join(', ')"></span>
            <span x-show="! selectedLabels.length" class="text-label-2">{{ $placeholder }}</span>
        </span>

        <span
            x-show="selectedLabels.length > 1"
            x-text="selectedLabels.length"
            class="rounded-full bg-accent/10 px-2 py-0.5 text-xs font-medium text-accent"
            aria-hidden="true"
        ></span>

        <svg
            class="size-5 shrink-0 text-label-2 transition-transform motion-reduce:transition-none"
            :class="open && 'rotate-180'"
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
        >
            <path
                fill-rule="evenodd"
                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                clip-rule="evenodd"
            />
        </svg>
    </button>

    <div
        id="{{ $panelId }}"
        x-ref="panel"
        x-show="open"
        x-transition:enter="transition ease-out duration-150 motion-reduce:transition-none"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75 motion-reduce:transition-none"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        role="group"
        aria-labelledby="{{ $labelId }}"
        class="absolute inset-x-0 z-50 mt-2 origin-top overflow-hidden rounded-xl bg-surface shadow-lg ring-1 ring-separator"
        style="display: none"
    >
        @if ($isSearchable)
            <div class="border-b border-separator p-2">
                <label for="{{ $name }}-search" class="sr-only">{{ __('common.filter_options') }}</label>
                <x-text-input
                    id="{{ $name }}-search"
                    x-ref="search"
                    x-model="query"
                    type="search"
                    :placeholder="__('common.filter_options')"
                    autocomplete="off"
                    class="h-11 w-full sm:h-9"
                    @keydown.enter.prevent
                />
            </div>
        @endif

        <ul class="max-h-64 overflow-y-auto py-1">
            @foreach ($options as $value => $optionLabel)
                <li x-show="matches(@js($optionLabel))">
                    <label
                        class="flex min-h-11 cursor-pointer select-none items-center gap-3 px-3 text-base text-label hover:bg-label/5 has-[:focus-visible]:bg-label/5 sm:min-h-9 sm:text-sm"
                    >
                        <input
                            type="checkbox"
                            name="{{ $name }}[]"
                            value="{{ $value }}"
                            data-label="{{ $optionLabel }}"
                            class="size-4 rounded border-field bg-surface text-accent focus:ring-accent"
                            @change="syncSelected()"
                            @checked(in_array((int) $value, $selected, true))
                        />
                        <span>{{ $optionLabel }}</span>
                    </label>
                </li>
            @endforeach
        </ul>

        @if ($isSearchable)
            <p x-show="! hasMatches" class="px-3 py-2 text-sm text-label-2">
                {{ __('common.nothing_found') }}
            </p>
        @endif
    </div>

    <x-input-error id="{{ $errorId }}" class="mt-2" :messages="$messages" />
</div>
