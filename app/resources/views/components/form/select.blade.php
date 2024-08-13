@props(['disabled' => false, 'required' => false, 'name', 'label' => false, 'hint' => false])
@php
    $n = $attributes->wire('model')->value() ?: $name;
    $slug = $attributes->wire('model')->value() ?: $n;
    $inputClass = 'h-10 block w-full border border-color-dee2e6 rounded focus:outline-none focus:ring-0 focus:ring-offset-0 placeholder:placeholder-color-c0c5c9 disabled:bg-color-f8f8f8 disabled:cursor-not-allowed';
@endphp
@error($slug)
@php
    $inputClass .= ' border-red-300 focus:outline-none text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500';
@endphp
@else
    @php
        $inputClass .= ' border-gray-300 focus:border-indigo-300 focus:ring-indigo-200';
    @endphp
    @enderror
    <div>
        @if($label || isset($action))
            <div class="flex items-center justify-between">
                @if ($label)
                    <x-form.input-label :for="$name" :required="$required">{{ $label }}</x-input-label>
                @endif
                @isset($action)
                    <div class="text-xs">
                        {{ $action }}
                    </div>
                @endisset
            </div>
        @endif
        <div class="relative @if($label || isset($action)) mt-2 @endif">
            <select
                {{ $attributes->merge(['class' => $inputClass]) }}
                {{ $disabled ? 'disabled' : '' }}
                name="{{ $slug }}"
                id="{{ $slug }}"
                {{ $required ? 'required' : '' }}
            >
                {{ $slot }}
            </select>
        </div>
        @if($hint)
            <p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>
        @endif
        <x-form.input-error :messages="$errors->get($slug)" class="mt-1"></x-input-error>
    </div>
