@props(['name', 'label' => false])
@php
    $n = $attributes->wire('model')->value() ?: $name;
    $slug = $attributes->wire('model')->value() ?: $n;
@endphp

<label {{ $attributes->class(['inline-flex items-center cursor-pointer']) }}>
    <input id="{{ $slug }}" name="{{ $slug }}" type="checkbox" class="sr-only peer" {{ $attributes->wire('model') }}>
    <div class="relative w-11 h-6 bg-color-dee2e6 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-color-dee2e6 after:border after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:bg-color-343a40"></div>
    <span class="ms-3 text-sm font-medium text-gray-900">{{ $label }}</span>
</label>
