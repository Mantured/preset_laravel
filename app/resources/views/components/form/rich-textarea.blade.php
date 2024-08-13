@props(['required' => false, 'name', 'label' => false, 'placeholder' => null])

@php
    $placeholder ?: $label;
    $rteId = Str::random(9);
@endphp

<div wire:ignore x-data="{
        value: @entangle($attributes->wire('model')).live,
        init() {
            let quill = new Quill('#rte-{{ $rteId }}', {
                theme: 'snow',
                placeholder: '{{ $placeholder }}',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['clean']
                    ],
                },
            });
            quill.root.innerHTML = this.value;
            quill.on('text-change', () => {
                this.value = quill.root.innerHTML.replace('<p><br></p>', '');
            });
            quill.focus()
        }
    }"
     class="border border-color-ffa084 rounded [&>.ql-toolbar]:!border-0 [&>.ql-toolbar]:!border-b [&>.ql-toolbar]:!border-color-dee2e6"
>
    @if($label)
        <div class="flex items-center justify-between mb-2">
            @if ($label)
                <x-form.input-label :for="$name" :required="$required">{{ $label }}</x-form.input-label>
            @endif
        </div>
    @endif
    <div id="rte-{{ $rteId }}" class="[&>.ql-editor]:h-[250px] !border-0"></div>
</div>

@assets
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endassets
