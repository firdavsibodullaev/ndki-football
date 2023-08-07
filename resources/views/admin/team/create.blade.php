@extends('admin.layouts.app')
@section('title', __('Новая команда'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h4 class="card-title">{{ __('Новая команда') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.team.store') }}"
                  method="post"
                  autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Название') }}</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="{{ __('Введите название') }}">
                    @error('name')
                    <span id="name-error"
                          class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <x-form.image-input :name="'logo'"
                                    :text="'Логотип'"
                                    :is-required="true"/>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ __('Сохранить') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
