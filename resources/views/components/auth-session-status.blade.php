@props(['status'])

@if ($status)
    <div role="status" {{ $attributes->merge(['class' => 'text-sm font-medium text-success']) }}>{{ $status }}</div>
@endif
