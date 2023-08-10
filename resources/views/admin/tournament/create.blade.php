@extends('admin.layouts.app')
@section('title', __('Новый турнир'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Новый турнир') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tournament.store') }}"
                  method="post"
                  autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">{{ __('Название') }}</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="{{ __('Ввыдите название') }}"
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
                            <label for="type">{{ __('Тип') }}</label>
                            <select class="form-control select2 @error('type') is-invalid @enderror"
                                    name="type"
                                    id="type"
                                    data-placeholder="{{ __('Выберите тип') }}"
                                    required>
                                <option value=""></option>
                                @foreach($types as $type)
                                    <option @selected($type->value === old('type'))
                                            value="{{ $type->value }}">{{ $type->translate() }}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <span id="name-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="icheck-primary">
                        <input type="checkbox"
                               name="is_home_away"
                               value="1"
                               class="@error('is_home_away') is-invalid @enderror"
                               @checked(old('is_home_away'))
                               id="is_home_away">
                        <label for="is_home_away">{{ __('Дома/В гостях') }}</label>
                        @error('is_home_away')
                        <span id="name-error"
                              class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpush
