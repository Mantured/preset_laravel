<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.auth')]
class Login extends Component
{
    /**
     * @var bool
     */
    public bool $showPassword = false;

    /**
     * @var string
     */
    #[Validate('required|email', onUpdate: false)]
    public string $email = '';

    /**
     * @var string
     */
    #[Validate('required|min:6', onUpdate: false)]
    public string $password = '';

    /**
     * @var bool
     */
    #[Validate('boolean')]
    public bool $rememberMe = false;

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function togglePassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function singIn()
    {
        $this->validate();

        if (Auth::attempt([...$this->only('email', 'password'), ...['active' => 1]], (bool) $this->rememberMe)) {
            return redirect()->route('dashboard');
        }

        $this->reset('password');
        $this->notification(
            'auth',
            'login.title',
            subtitle: 'login.subtitle',
            type: 'error'
        );
    }
}
