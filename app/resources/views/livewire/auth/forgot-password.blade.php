<form class="flex flex-col space-y-5 mt-5" wire:submit="sendResetLink">
    <h3 class="text-center text-color-343a40 font-medium">{{ __('auth.title.forgot_password') }}</h3>
    <p class="px-5 text-color-a9acaf text-center text-sm">{{ __('auth.intro.forgot_password') }}</p>
    <x-form.input name="email" wire:model="email" label="{{ __('auth.form.email') }}" />
    <x-form.button class="w-full">{{ __('auth.form.send_link_password') }}</x-form.button>
</form>
