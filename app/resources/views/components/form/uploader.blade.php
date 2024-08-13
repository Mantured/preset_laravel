@props(['name', 'required' => false, 'label' => false, 'multiple' => false, 'rules' => ['image', 'mimes:png,jpeg,svg', 'max:5210']])
<div>
    @if ($label)
        <x-form.input-label :for="$name" :required="$required" class="mb-2">{{ $label }}</x-form.input-label>
    @endif
    <livewire:dropzone
        :multiple="$multiple"
        :wire:model.live="$name"
        :rules="$rules"
    />
    <x-form.input-error :messages="$errors->get($name)" class="mt-1"></x-form.input-error>
</div>
