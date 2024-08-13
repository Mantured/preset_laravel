<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.auth')]
class ResetPassword extends Component
{
    /**
     * @var string
     */
    #[Validate('required|email', onUpdate: false)]
    public string $email = '';

    /**
     * @var string
     */
    #[Validate('required|min:6|same:passwordConfirmation', onUpdate: false)]
    public string $password = '';

    /**
     * @var string
     */
    public string $passwordConfirmation = '';

    /**
     * @var array
     */
    public array $showPassword = [
        'new'     => false,
        'confirm' => false,
    ];

    /**
     * @var string
     */
    public string $token;

    /**+
     * @param Request $request
     */
    public function mount(Request $request)
    {
        $this->email = $request->get('email');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.auth.reset-password');
    }

    /**
     * @param string $field
     */
    public function togglePassword(string $field)
    {
        if (isset($this->showPassword[$field])) {
            $this->showPassword[$field] = !$this->showPassword[$field];
        }
    }

    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            $this->only('email', 'password', 'passwordConfirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        $this->reset('password', 'passwordConfirmation');

        if ($status === Password::PASSWORD_RESET) {
            $this->redirectRoute('login', navigate: true);
        }

        $this->notification(
            'auth',
            'reset_password.title',
            subtitle: 'reset_password.subtitle',
            type: $status === Password::PASSWORD_RESET ? 'success' : 'error'
        );
    }
}
