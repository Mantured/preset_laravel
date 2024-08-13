<form class="flex flex-col space-y-5 mt-5" wire:submit="singIn">
    <p class="px-5 text-color-a9acaf text-center text-sm">{{ __('auth.intro.login') }}</p>
    <x-form.input name="email" wire:model="email" label="{{ __('auth.form.email') }}" />
    <x-form.input type="{{ $showPassword ? 'text' : 'password'}}" name="password" wire:model="password" label="{{ __('auth.form.password') }}">
        <x-slot:action>
            <a class="ml-auto text-color-343a40 underline hover:no-underline" tabindex="-1"
               href="{{ route('password.request') }}">{{ __('auth.forget_link') }}</a>
        </x-slot:action>
        <x-slot:append>
            <span
                wire:click="togglePassword"
                class="absolute z-[1] inset-y-0 right-0 flex items-center justify-center w-11 bg-color-e4edfa rounded-sm cursor-pointer">
                <x-icon name="{{ $showPassword ? 'eye-alt-barred' : 'eye-alt' }}" class="w-4 h-4 fill-color-85a7d8" />
            </span>
        </x-slot:append>
    </x-form.input>
    <x-form.checkbox name="remember_me" label="{{ __('auth.form.remember_me') }}" />
    <x-form.button class="w-full">{{ __('auth.form.sign_in') }}</x-form.button>
</form>
