@extends('admin.layouts.app')
@section('title', __('Профиль'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Профиль') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="post" autocomplete="off">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">{{ __('Имя') }}</label>
                            <input type="text"
                                   class="form-control @error('name', 'user') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="{{ __('Введите имя') }}"
                                   value="{{ $user->name }}"
                                   required>
                            @error('name', 'user')
                            <span id="name-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="username">{{ __('Логин') }}</label>
                            <input type="text"
                                   class="form-control @error('username', 'user') is-invalid @enderror"
                                   id="username"
                                   name="username"
                                   placeholder="{{ __('Введите логин') }}"
                                   value="{{ $user->username }}"
                                   required>
                            @error('username', 'user')
                            <span id="username-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __("Сохранить") }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Пароль') }}</h5>
        </div>
        <div class="card-body">
            @include('admin.layouts.message')
            <form action="{{ route('admin.profile.update_password') }}" method="post" autocomplete="off">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">{{ __('Пароль') }}</label>
                            <input type="password"
                                   class="form-control @error('password', 'password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="{{ __('Введите пароль') }}"
                                   required>
                            @error('password', 'password')
                            <span id="password-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Подтверждение пароля') }}</label>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="{{ __('Подтвердите пароль') }}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __("Сохранить") }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
