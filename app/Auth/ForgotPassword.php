<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.auth')]
class ForgotPassword extends Component
{
    /**
     * @var string
     */
    #[Validate('required|email')]
    public string $email = '';

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }

    public function sendResetLink()
    {
        $this->validate();

        if (!User::role(User::SUPERADMIN)->where('email', $this->only('email'))->exists()) {
            $this->notification(
                'auth',
                'forgot_password.title',
                subtitle: 'forgot_password.subtitle',
                type: 'error',
                disableClose: true
            );
        } else {
            $status = Password::sendResetLink($this->only('email'));

            $this->notification(
                'auth',
                'forgot_password.title',
                subtitle: 'forgot_password.subtitle',
                disableClose: true
            );
        }

        $this->reset('email');
    }
}
