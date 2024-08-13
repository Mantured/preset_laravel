@props(['disabled' => false, 'required' => false, 'name', 'label' => false, 'hint' => false, 'append' => false, 'prepend' => false, 'iconColor' => 'text-gray-800', 'hideErrorMsg' => false])
@php
    $n = $attributes->wire('model')->value() ?: $name;
    $slug = $attributes->wire('model')->value() ?: $n;
    $inputClass = 'h-10 block w-full text-color-343a40 focus:outline-none focus:ring-0 focus:ring-offset-0 placeholder:placeholder-color-c0c5c9';
    $inputClass .= $disabled  ? ' bg-color-f8f8f8 rounded-sm border-0' : ' border border-color-dee2e6 rounded';
@endphp
@error($slug)
@php
    $inputClass .= ' border-transparent bg-red-50';
@endphp
@else
    @php
        $inputClass .= ' focus:border-indigo-300 focus:ring-indigo-200';
    @endphp
    @enderror
    @if($prepend)
        @php
            $inputClass .= ' pl-11';
        @endphp
    @endif
    @if($append)
        @php
            $inputClass .= ' pr-11';
        @endphp
    @endif

    <div>
        @if($label || isset($action))
            <div class="flex items-center justify-between">
                @if ($label)
                    <x-form.input-label :for="$name" :required="$required">{{ $label }}</x-form.input-label>
                @endif
                @isset($action)
                    <div class="text-xs">
                        {{ $action }}
                    </div>
                @endisset
            </div>
        @endif
        <div class="relative @if($label || isset($action)) mt-2 @endif">
            @if($prepend)
                {{ $prepend }}
            @endif
            <input
                {{ $attributes->merge(['class' => $inputClass]) }}
                {{ $attributes['type'] == 'number' && !$attributes['step'] ? 'step=0.001' : 'step=$attributes[\'step\']' }}
                {{ $disabled ? 'disabled' : '' }}
                name="{{ $slug }}"
                id="{{ $slug }}"
                {{ $required ? 'required' : '' }}
            >
            @if($append)
                {{ $append }}
            @endif
        </div>
        @if($hint)
            <p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>
        @endif
        @if(!$hideErrorMsg)
        <x-form.input-error :messages="$errors->get($slug)" class="mt-1"></x-form.input-error>
        @endif
    </div>
