@extends('admin.layouts.app')
@section('title', $player->name_initials)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h4 class="card-title">{{ __('Редактирование игрока') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ rroute('admin.player.update', $player->id) }}"
                  method="post"
                  autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="last_name">{{ __('Фамилия') }}</label>
                            <input type="text"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name"
                                   name="last_name"
                                   value="{{ $player->last_name }}"
                                   placeholder="{{ __('Введите фамилию') }}">
                            @error('last_name')
                            <span id="last_name-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="first_name">{{ __('Имя') }}</label>
                            <input type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name"
                                   name="first_name"
                                   value="{{ $player->first_name }}"
                                   placeholder="{{ __('Введите имя') }}">
                            @error('first_name')
                            <span id="first_name-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="patronymic">{{ __('Отчество') }}</label>
                            <input type="text"
                                   class="form-control @error('patronymic') is-invalid @enderror"
                                   id="patronymic"
                                   name="patronymic"
                                   value="{{ $player->patronymic }}"
                                   placeholder="{{ __('Введите отчество') }}">
                            @error('patronymic')
                            <span id="patronymic-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="team_id">{{ __('Команда') }}</label>
                            <select name="team_id"
                                    class="select2 w-100"
                                    data-placeholder="{{ __('Выберите команду') }}"
                                    required
                                    id="team_id">
                                <option value=""></option>
                                @foreach($teams as $team)
                                    <option @selected($team->id == $player->team_id)
                                            value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @error('team_id')
                            <span id="team_id-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="number">{{ __('Номер') }}</label>
                            <input type="number"
                                   class="form-control @error('number') is-invalid @enderror"
                                   id="number"
                                   name="number"
                                   value="{{ $player->number }}"
                                   placeholder="{{ __('Введите номер') }}">
                            @error('number')
                            <span id="number-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-form.image-input :name="'avatar'"
                                    :text="'Аватар'"
                                    :file="$player->avatar"/>
                <div class="form-group">
                    <label for="is_active">Статус</label>
                    <select name="is_active"
                            class="form-control"
                            id="is_active"
                            required>
                        <option value="0" @selected(!$player->is_active)>Не активно</option>
                        <option value="1" @selected($player->is_active)>Активно</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ __('Сохранить') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpush
