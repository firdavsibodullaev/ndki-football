<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Авторизация</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        {{ config('app.name') }}
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Вход в систему</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text"
                           name="username"
                           value="{{ old('username') }}"
                           class="form-control @error('username') is-invalid @enderror"
                           placeholder="Логин">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('username')
                    <span class="error invalid-feedback"
                          id="username-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback"
                          id="password-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox"
                                   @checked(old('remember'))
                                   name="remember"
                                   id="remember">
                            <label for="remember">
                                Запомнить
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
</body>
</html>
