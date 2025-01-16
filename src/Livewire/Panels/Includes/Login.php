<?php

namespace SmNet\LaravelRlf\Livewire\Panels\Includes;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public $formEmail;
    public $formPassword;
    public $formRememberMe = true;
    public function updated()
    {
        $this->validate([
            'formEmail'=> 'required|email|min:1',
            'formPassword'=> 'required|min:1',
        ],[],
            [
                'formEmail'=> '<span style="font-weight: bold;">Email</span>',
                'formPassword'=> '<span style="font-weight: bold;">Пароль</span>',
            ]);


    }
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->formEmail, 'password' => $this->formPassword], $this->formRememberMe)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'formEmail' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'formEmail' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->formEmail).'|'.request()->ip());
    }

    public function login()
    {
        $this->validate([
            'formEmail'=> 'required|email|min:1',
            'formPassword'=> 'required|min:1',
        ],[],
            [
                'formEmail'=> '<span style="font-weight: bold;">Email</span>',
                'formPassword'=> '<span style="font-weight: bold;">Пароль</span>',
            ]);

        $this->authenticate();
        Session::regenerate();
        $this->redirect(route('admin_portal.main'));
    }
    public function changePages($action)
    {
        $this->dispatch('changePages',action: $action);
    }
    public function render()
    {
        return view('LaravelRlf::livewire.rlf-system.include.login');
    }
}
