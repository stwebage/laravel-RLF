<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <form wire:submit="login" class="col-11 col-md-8 col-lg-6 col-xl-4 my-5">
        <div class="card my-5">
            <div class="card-body">
                <div class="text-center mb-3">
                    <a href="{{route('login')}}"><img src="{{asset('/vendor/LaravelRlf/images/logo/svs-svs-logo.webp')}}" alt="SVS logo" width="168"></a>
                </div>
                <h4 class="text-center f-w-500 mb-3">Войти с помощью Email и пароля</h4>
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
                <div class="mb-3 row">
                    <div class="col-12">
                        <input type="password" class="form-control @error('formPassword') error @enderror" id="password"  placeholder="Пароль" autocomplete="current-password" wire:model.live="formPassword"/>
                    </div>
                    @error('formPassword')
                    <div class="col-12 animate__animated animate__pulse">
                        <div class="error-message" id="bouncer-error_password">{!! $message !!}</div>
                    </div>
                    @enderror
                </div>
                <div class="d-flex mt-1 justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input input-primary" type="checkbox" id="checkbox" wire:model.live="formRememberMe" />
                        <label class="form-check-label text-muted" for="checkbox">Запомнить меня?</label>
                    </div>
                    <h6 class="text-secondary f-w-400 mb-0">
                        <a href="#!" wire:click.prevent="$parent.changePages('forgotPassword')"> Забыли пароль </a>
                    </h6>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Вход</button>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <h6 class="f-w-500 mb-0">Нет аккаунта?</h6>
                    <a href="#!" class="link-primary" wire:click.prevent="$parent.changePages('register')">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </form>
</div>