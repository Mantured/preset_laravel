@props([
    'by' => 'created_at|=',
    'mode' => 'single',
    'action' => false,
    'append' => false,
    'prepend' => false,
    'tableFilter' => false,
    'label' => false,
    'time' => false,
    'class' => '',
])

<div>
    <div
        wire:ignore.self
        x-data="{
                isTableFilter: {{ (int) $tableFilter }},
				value: @entangle(($tableFilter ? 'filters.'.explode('|', $by)[0] : $attributes->wire('model'))),
				datePicker: null,
				clearCalendar: false,
				init() {
				    this.datePicker = flatpickr(this.$refs.picker, {
				        locale: flatpickrIt,
				        mode: '{{ $mode }}',
				        dateFormat: '{{ $time ? 'H:i' : 'd-m-Y' }}',
				        defaultDate: this.value,
				        allowInput: false,
				        enableTime: @json($time),
                        noCalendar: @json($time),
                        time_24hr: true,
				        onChange: (date, dateString) => {
				            if ('{{ $mode }}' === 'range' && date.length > 0 && date.length < 2) {
				                return;
				            }
				            this.value = dateString.split(' al ');
				            this.clearCalendar = true;
				            if (this.isTableFilter) {
				                this.column = '{{ $by }}'.split('|')[0];
				                this.operator = '{{ $mode }}' === 'single' ? '{{ $by }}'.split('|')[1] : null;
				                Livewire.dispatch('date_changed.'+this.column, {mode: (this.value.length === 1 && '{{ $mode }}' === 'range' ? 'single' : '{{ $mode }}'), column: this.column, operator: this.operator, value: this.value});
				            }
				        }
				    });
				},
				clear() {
				    this.datePicker.clear();
				    this.clearCalendar = false;
				}
        }">
        <x-form.input autocomplete="off" type="text" x-ref="picker" {{ $attributes->merge(['class' => $class, 'label' => $label]) }}>
            @if ($action)
                <x-slot:action>{{ $action }}</x-slot:action>
            @endif
                <x-slot:append>
                    <span class="absolute z-[1] inset-y-0 right-0 flex items-center justify-center w-11 bg-color-ebebeb rounded-sm" :class="clearCalendar && 'cursor-pointer'">
                        <x-icon x-show="!clearCalendar" name="calendar" class="w-4 h-4 fill-color-6c757d"/>
                        <x-icon x-show="clearCalendar" @click="clear()" name="close" class="w-4 h-4 fill-color-6c757d"/>
                    </span>
                </x-slot:append>
            @if ($prepend)
                <x-slot:prepend>{{ $prepend }}</x-slot:prepend>
            @endif
        </x-form.input>
        {{--		<x-form.input-error for="{{ $for }}" class="mt-1"/>--}}
    </div>
{{--    <x-form.input-error :messages="$errors->get($attributes->wire('model')->value())" class="mt-1"></x-form.input-error>--}}
</div>

@assets
    @vite(['resources/js/flatpickr.js'])
@endassets
