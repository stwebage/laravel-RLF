<?php

namespace SmNet\LaravelRlf\Livewire\Panels\Includes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public $formName;
    public $formEmail;
    public $formPassword;
    public $formPassword_confirmation;

    public function updated()
    {
        $this->validate([
            'formName'=> 'required|string|min:1',
            'formEmail'=> 'required|email|lowercase|min:1|unique:users,email',
            'formPassword'=> 'required|confirmed|min:1',
        ],[],
            [
                'formName'=> '<span style="font-weight: bold;">Имя пользователя</span>',
                'formEmail'=> '<span style="font-weight: bold;">Email</span>',
                'formPassword'=> '<span style="font-weight: bold;">Пароль</span>',
            ]);


    }

    public function register()
    {
        $this->validate([
            'formName'=> 'required|string|min:1',
            'formEmail'=> 'required|email|lowercase|min:1|unique:users,email',
            'formPassword'=> 'required|confirmed|min:1',
        ],[],
            [
                'formName'=> '<span style="font-weight: bold;">Имя пользователя</span>',
                'formEmail'=> '<span style="font-weight: bold;">Email</span>',
                'formPassword'=> '<span style="font-weight: bold;">Пароль</span>',
            ]);
        $password = Hash::make($this->formPassword);
        $user = User::create([
            'name' => $this->formName,
            'email' => $this->formEmail,
            'password' => $password,
        ]);

        Auth::login($user, true);
        $this->redirect(route('admin_portal.main'));
    }

    public function render(){
        return view('LaravelRlf::livewire.rlf-system.include.register');
    }
}
