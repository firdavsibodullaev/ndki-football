@extends('admin.layouts.app')
@section('title', $season->name)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">Редактирование сезона</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.season.update', $season->id) }}"
                  method="post"
                  autocomplete="off">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           name="name"
                           value="{{ $season->name }}"
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
                                   value="{{ $season->started_at->format('Y-m-d') }}"
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
                                   value="{{ $season->finished_at->format('Y-m-d') }}"
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
