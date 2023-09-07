@extends('admin.layouts.app')
@section('title', __('Новый пользователь'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Новый пользователь') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}"
                  method="post"
                  autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">{{ __('Имя') }}</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="{{ __('Введите имя') }}"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                            <span id="name-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="username">{{ __('Логин') }}</label>
                            <input type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   id="username"
                                   name="username"
                                   placeholder="{{ __('Введите логин') }}"
                                   value="{{ old('username') }}"
                                   required>
                            @error('username')
                            <span id="username-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">{{ __('Пароль') }}</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="{{ __('Введите пароль') }}"
                                   required>
                            @error('password')
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
                    <div class="col-12">
                        <div class="form-group">
                            <label for="role">{{ __('Роль') }}</label>
                            <select name="role" id="role" required
                                    data-placeholder="{{ __('Выберите роль') }}"
                                    class="select2 w-100 @error('role') is-invalid @enderror">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option @selected(old('role') == $role->value)
                                            value="{{ $role->value }}">{{ $role->translate() }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <span id="role-error"
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
@endsection
@pushOnce('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpushOnce
@pushOnce('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpushOnce
