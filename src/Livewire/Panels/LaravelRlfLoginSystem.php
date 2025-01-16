<?php

namespace SmNet\LaravelRlf\Livewire\Panels;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
class LaravelRlfLoginSystem extends Component
{
    #[Url(history: true)]
    public $action = 'login';

    public function mount(): void
    {
        if(Auth::check() && $this->action!='logout'){
            $this->redirect(route('admin_portal.main'));
        }
        if($this->action!='login' && $this->action!='register' && $this->action!='forgotPassword' && $this->action!='logout'){
            $this->action = 'login';
        }

        $this->pageTitle($this->action);
    }

    public function changePages($action): void
    {
        $this->action = $action;
        $this->pageTitle($this->action);
    }
    public function pageTitle($action): void
    {
        if($action=='forgotPassword'){
            $this->dispatch('titleChange', title: 'Форма восстановления пароля | Панель управления контентом');
        }elseif($action=='login'){
            $this->dispatch('titleChange', title: 'Форма входа в систему | Панель управления контентом');
        }elseif($action=='register'){
            $this->dispatch('titleChange', title: 'Форма регистрации нового пользователя | Панель управления контентом');
        }elseif($action=='logout'){
            $this->dispatch('titleChange', title: 'Выход из системы | Панель управления контентом');
        }
    }

    public function render()
    {
        return view('LaravelRlf::livewire.rlf-system.main')->layout('layouts.panel');
    }
}