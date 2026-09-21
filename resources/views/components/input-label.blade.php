@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-label']) }}> {{ $value ?? $slot }} </label>
