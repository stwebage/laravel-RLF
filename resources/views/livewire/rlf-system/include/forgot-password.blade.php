<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="card my-5 col-11 col-md-8 col-lg-6 col-xl-4 my-5">
            <div class="card-body">
                <div class="text-center mb-3">
                    <a href="{{route('login')}}"><img src="{{asset('/vendor/LaravelRlf/images/logo/svs-logo.webp')}}" alt="SVS logo" width="168"></a>
                </div>
                <h4 class="text-center f-w-500 mb-3">Восстановить пароль</h4>
                @if(!$this->newPasswordStatus)
                    @if(!$this->status)
                    <form wire:submit="forgot">
                    <div class="mb-3 row">
                        <div class="col-12">
                            <input type="email" class="form-control @error('formEmail') error @enderror" id="email" placeholder="Email" autocomplete="email" wire:model.live="formEmail"/>
                        </div>
                        @error('formEmail')
                        <div class="col-12 animate__animated animate__pulse">
                            <div class="error-message" id="bouncer-error_password">{!! $message !!}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Восстановить пароль</button>
                    </div>
                    </form>
                    <div class="d-flex justify-content-between align-items-end mt-4">
                        <h6 class="f-w-500 mb-0">Нет аккаунта?</h6>
                        <a href="#!" class="link-primary" wire:click.prevent="$parent.changePages('register')">Зарегистрироваться</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-4">
                        <h6 class="f-w-500 mb-0">Есть аккаунт?</h6>
                        <a href="#!" class="link-primary" wire:click.prevent="$parent.changePages('login')">Войти</a>
                    </div>
                    @else
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fa-sharp-duotone fa-solid fa-check flex-shrink-0 me-2" style="font-size:35px;"></i>
                            <div> Ссылка на восстановление пароля отправлена на ваш Email </div>
                        </div>
                    @endif
                @else
                    @if($this->newPassForm)
                        <form wire:submit="setPassword">
                        <div class="mb-3 row">
                            <div class="col-12">
                                <input type="password" class="form-control @error('formPassword') error @enderror" id="password"  placeholder="Пароль" autocomplete="new-password" wire:model.live="formPassword"/>
                            </div>
                            @error('formPassword')
                            <div class="col-12 animate__animated animate__pulse">
                                <div class="error-message" id="bouncer-error_password">{!! $message !!}</div>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="col-12">
                                <input type="password" class="form-control @error('formPassword_confirmation') error @enderror" id="password"  placeholder="Повтор пароля" autocomplete="new-password" wire:model.live="formPassword_confirmation"/>
                            </div>
                            @error('formPassword_confirmation')
                            <div class="col-12 animate__animated animate__pulse">
                                <div class="error-message" id="bouncer-error_password">{!! $message !!}</div>
                            </div>
                            @enderror
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Установить пароль</button>
                        </div>
                        </form>
                    @else
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fa-sharp-duotone fa-solid fa-octagon-exclamation flex-shrink-0 me-2" style="font-size:35px;"></i>
                            <div> Ссылка не действительна, попробуйте запросить ссылку на восстановления пароля еще раз </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
</div>
