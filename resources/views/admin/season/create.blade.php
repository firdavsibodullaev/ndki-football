@extends('admin.layouts.app')
@section('title', __('Новый сезон'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">Новый сезон</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.season.store') }}"
                  method="post"
                  autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Введите название"
                           required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="started_at">Дата начала</label>
                            <input type="date"
                                   name="started_at"
                                   id="started_at"
                                   class="form-control"
                                   value="{{ old('started_at') }}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="finished_at">Дата окончания</label>
                            <input type="date"
                                   name="finished_at"
                                   id="finished_at"
                                   class="form-control"
                                   value="{{ old('finished_at') }}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
