@extends('admin.layouts.app')
@section('title', $team->name)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h4 class="card-title">{{ __('Редактирование команды') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ rroute('admin.team.update', $team->id) }}"
                  method="post"
                  autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">{{ __('Название') }}</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ $team->name }}"
                           placeholder="{{ __('Введите название') }}">
                    @error('name')
                    <span id="name-error"
                          class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <x-form.image-input :name="'logo'"
                                    :text="'Логотип'"
                                    :file="$team->logo"/>
                <div class="form-group">
                    <label for="is_active">Статус</label>
                    <select name="is_active"
                            class="form-control"
                            id="is_active"
                            required>
                        <option value="0" @selected(!$team->is_active)>Не активно</option>
                        <option value="1" @selected($team->is_active)>Активно</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
