@extends('admin.layouts.app')
@section('title', $season->name)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Редактирование сезона') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ rroute('admin.season.update', $season->id) }}"
                  method="post"
                  autocomplete="off">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">{{ __('Название') }}</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ $season->name }}"
                           placeholder="Введите название"
                           required>
                    @error('name')
                    <span id="name-error"
                          class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="started_at">{{ __('Дата начала') }}</label>
                            <input type="date"
                                   name="started_at"
                                   id="started_at"
                                   class="form-control @error('started_at') is-invalid @enderror"
                                   value="{{ $season->started_at->format('Y-m-d') }}"
                                   required>
                            @error('started_at')
                            <span id="started_at-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="finished_at">{{ __('Дата окончания') }}</label>
                            <input type="date"
                                   name="finished_at"
                                   id="finished_at"
                                   class="form-control @error('finished_at') is-invalid @enderror"
                                   value="{{ $season->finished_at->format('Y-m-d') }}"
                                   required>
                            @error('finished_at')
                            <span id="finished_at-error"
                                  class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
