@extends('admin.layouts.app')
@section('title', __('Турниры'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Турниры') }}</h5>
        </div>
        <div class="card-body">

            <div class="my-3">
                <a href="{{ route('admin.tournament.create') }}" class="btn btn-primary">{{ __('Новый турнир') }}</a>
            </div>

            <table class="table table-striped text-center">
                <thead>
                <tr>
                    <th style="width:1.5rem">ID</th>
                    <th>{{ __('Название') }}</th>
                    <th>{{ __('Тип') }}</th>
                    <th>{{ __('Дома/В гостях') }}</th>
                    <th class=" pr-5"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tournaments as $tournament)
                    <tr>
                        <td>{{ $tournament->id }}</td>
                        <td>{{ $tournament->name }}</td>
                        <td>{{ $tournament->type->translate() }}</td>
                        <td>{!! is_active($tournament->is_home_away) !!}</td>
                        <td class="text-right pr-5">
                            <a href="{{ route('admin.tournament.show', $tournament->id) }}"
                               class="btn btn-success">
                                {{ __('Смотреть') }}
                            </a>
                            <a href="{{ route('admin.tournament.edit', $tournament->id) }}"
                               class="btn btn-warning">
                                {{ __('Изменить') }}
                            </a>
                            <a href="javascript:void(0)"
                               onclick="openDeleteModal(this)"
                               data-id="{{ $tournament->id }}"
                               class="btn btn-danger">
                                {{ __('Удалить') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-modals.delete-modal :action="route('admin.tournament.destroy', 'ID0')"/>
@endsection
