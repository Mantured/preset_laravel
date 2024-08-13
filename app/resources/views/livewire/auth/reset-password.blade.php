<form class="space-y-5 mt-5" wire:submit="resetPassword">
    <h3 class="text-center text-color-343a40 font-medium">{{ __('auth.title.reset_password') }}</h3>
    <x-form.input name="email" wire:model="email" label="{{ __('auth.form.email') }}" />
    <x-form.input type="{{ $showPassword['new'] ? 'text' : 'password'}}" name="password" wire:model="password" label="{{ __('auth.form.password') }}">
        <x-slot:append>
            <span
                wire:click="togglePassword('new')"
                class="absolute z-[1] inset-y-0 right-0 flex items-center justify-center w-11 bg-color-e4edfa rounded-sm cursor-pointer">
                <x-icon name="{{ $showPassword['new'] ? 'eye-alt-barred' : 'eye-alt' }}" class="w-4 h-4 fill-color-85a7d8" />
            </span>
        </x-slot:append>
    </x-form.input>
    <x-form.input type="{{ $showPassword['confirm'] ? 'text' : 'password'}}" name="password" wire:model="passwordConfirmation" label="{{ __('auth.form.password') }}">
        <x-slot:append>
            <span
                wire:ignore
                wire:click="togglePassword('confirm')"
                class="absolute z-[1] inset-y-0 right-0 flex items-center justify-center w-11 bg-color-e4edfa rounded-sm cursor-pointer">
                <x-icon name="{{ $showPassword['confirm'] ? 'eye-alt-barred' : 'eye-alt' }}" class="w-4 h-4 fill-color-85a7d8" />
            </span>
        </x-slot:append>
    </x-form.input>
    <x-form.button class="w-full">{{ __('auth.form.reset_password') }}</x-form.button>
</form>
