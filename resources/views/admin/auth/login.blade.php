@extends('admin.layouts.auth.app')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('admin.index') }}">{{ config('app.name') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ __('Вход в систему') }}</p>

                <form action="{{ route('admin.login') }}" autocomplete="off" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text"
                               class="form-control @error('username') is-invalid @enderror"
                               name="username"
                               value="{{ old('username') }}"
                               placeholder="{{ __('Логин') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('username')
                        <span id="username-error"
                              class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="{{ __('Пароль') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    {{ __('Запомнить') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Войти') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
