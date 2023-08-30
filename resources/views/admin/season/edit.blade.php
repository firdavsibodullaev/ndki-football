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
                <div class="row">
                    <div class="col-6">
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
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tournament_id">{{ __('Турнир') }}</label>
                            <select name="tournament_id"
                                    class="select2 w-100 @error('tournament_id') is-invalid @enderror"
                                    id="tournament_id"
                                    data-placeholder="{{ __('Выберите турнир') }}"
                                    required>
                                <option value=""></option>
                                @foreach($tournaments as $tournament)
                                    <option @selected($tournament->id == $season->tournament_id)
                                            value="{{ $tournament->id }}"
                                    >{{ $tournament->name }}</option>
                                @endforeach
                            </select>
                            @error('tournament_id')
                            <span id="tournament_id-error"
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
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpush
