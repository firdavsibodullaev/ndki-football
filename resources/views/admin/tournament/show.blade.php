@extends('admin.layouts.app')
@section('title', $tournament->name)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ $tournament->name }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h4 class="mb-3">{{ __('Сезоны') }}</h4>
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th style="width:1.5rem">ID</th>
                            <th>{{ __('Название') }}</th>
                            <th>{{ __('Даты') }}</th>
                            <th>{{ __('Текущий сезон') }}</th>
                            <th style="width: 25rem;" class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tournament->seasons as $season)
                            <tr>
                                <td>{{ $season->id }}</td>
                                <td>{{ $season->name }}</td>
                                <td>{{ $season->dates }}</td>
                                <td>{!! is_active($season->is_current) !!}</td>
                                <td style="width: 25rem;" class="text-center">
                                    <a href="{{ route('admin.season.show', $season->id) }}"
                                       class="btn btn-success">
                                        {{ __('Смотреть') }}
                                    </a>
                                    <a href="{{ route('admin.season.edit', $season->id) }}?from=tournament-show&id={{ $tournament->id }}"
                                       class="btn btn-warning">
                                        {{ __('Изменить') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-4 border-left">
                    <h5><strong>{{ __('Название') }}:</strong> {{ $tournament->name }}</h5>
                    <hr>
                    <h5><strong>{{ __('Тип') }}:</strong> {{ $tournament->type->translate() }}</h5>
                    <hr>
                    <h5><strong>{{ __('Дома/В гостях') }}:</strong> {!! is_active($tournament->is_home_away) !!}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
