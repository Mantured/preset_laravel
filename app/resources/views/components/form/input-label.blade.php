@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'flex text-xs text-color-6c757d']) }}>
    {{ $value ?? $slot }} @if($required)<span class="ml-0.5">*</span>@endif
</label>
