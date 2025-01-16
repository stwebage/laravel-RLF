<?php
namespace SmNet\LaravelRlf\Livewire\Panels\Includes;

use App\Mail\MailForgotKeyLink;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\User;
use Mail;
use SmNet\LaravelRlf\Model\ForgotPasswordKey;
use Str;

class ForgotPassword extends Component
{
    #[Url(history: true)]
    public $key;
    public $status=false;
    public $newPasswordStatus=false;
    public $newPassForm=false;
    public $formEmail;
    public $formPassword;
    public $formPassword_confirmation;
    public function updated($propertyName)
    {

       if($propertyName=='formPassword' || $propertyName=='formPassword_confirmation'){
           $this->validate([
               'formPassword'=> 'required|confirmed|min:1',
           ],[],
               [
                   'formPassword'=> '<span style="font-weight: bold;">Пароль</span>',
               ]);

       }elseif($propertyName=='formEmail'){
           $this->validate([
               'formEmail'=> 'required|email|min:1',
           ],[],
               [
                   'formEmail'=> '<span style="font-weight: bold;">Email</span>',
               ]);

       }


    }
    public function forgot()
    {
        $this->validate([
            'formEmail'=> 'required|email|min:1',
        ],[],
            [
                'formEmail'=> '<span style="font-weight: bold;">Email</span>',
            ]);
       $checkUser = User::where('email',$this->formEmail)->first();
       if($checkUser){
            $checkKey = ForgotPasswordKey::where('user_id',$checkUser->id)->where('status',0)->first();
            if($checkKey){
                $dataTimeKeyCreatePlusFiveMinutes = Carbon::parse($checkKey->created_at)->addMinutes(5);
                if(Carbon::now()>$dataTimeKeyCreatePlusFiveMinutes){
                    $checkKey->delete();
                    $keyData = Str::random(18);
                    $newKey = new ForgotPasswordKey();
                    $newKey->user_id = $checkUser->id;
                    $newKey->key = $keyData;
                    $newKey->save();
                    $this->status=true;
                    Mail::to($this->formEmail)->send(new MailForgotKeyLink([
                        'key' => $keyData,
                    ]));
                }
                throw ValidationException::withMessages([
                    'formEmail' => 'Вами уже был запрошен код восстановления. Новый код можно запросить через 5 минут',
                ]);
            }else{
                $keyData = Str::random(18);
                $newKey = new ForgotPasswordKey();
                $newKey->user_id = $checkUser->id;
                $newKey->key = $keyData;
                $newKey->save();

                Mail::to($this->formEmail)->send(new MailForgotKeyLink([
                    'key' => $keyData,
                ]));
            }
       }else{
           throw ValidationException::withMessages([
               'formEmail' => 'Пользователь с таким <span style="font-weight: bold;">Email</span> не найден',
           ]);
       }
    }
    public function setPassword()
    {
        $this->validate([
            'formPassword'=> 'required|confirmed|min:1',
        ],[],
            [
                'formPassword'=> '<span style="font-weight: bold;">Пароль</span>',
            ]);
        if(mb_strlen($this->key)===18){
            $checkKey = ForgotPasswordKey::where('key','=',$this->key)->where('status',0)->first();
            if($checkKey){
                $checkUser = User::where('id',$checkKey->user_id)->first();
                if($checkUser){
                    $checkUser->update([
                        'password'=>Hash::make($this->formPassword),
                    ]);
                    $checkKey->delete();
                    Auth::login($checkUser, true);
                    $this->redirect(route('admin_portal.main'));
                }
            }
        }
    }
    public function render(){
        if($this->key!=''){
            $this->newPasswordStatus=true;
            if(mb_strlen($this->key)===18){
                $checkKey = ForgotPasswordKey::where('key','=',$this->key)->where('status',0)->first();
                if($checkKey){
                    $this->newPassForm = true;
                }
            }
        }
        return view('LaravelRlf::livewire.rlf-system.include.forgot-password');
    }
}
