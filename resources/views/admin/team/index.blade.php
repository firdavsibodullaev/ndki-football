@extends('admin.layouts.app')
@section('title', __('Команды'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Команды') }}</h5>
        </div>
        <div class="card-body">

            <div class="my-3">
                <a href="{{ route('admin.team.create') }}" class="btn btn-primary">{{ __('Новая команда') }}</a>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width:1.5rem">ID</th>
                    <th style="width:1.5rem">{{ __('Лого') }}</th>
                    <th style="width:25rem">{{ __('Название') }}</th>
                    <th style="width:1.5rem" class="text-center">{{ __('Статус') }}</th>
                    <th class=" pr-5"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>
                            <div class="d-flex h-100 align-content-center justify-content-center">
                                <x-fancy-box :url="$team->logo?->getFullUrl()"
                                             :alt="$team->logo?->file_name"
                                             :css="'width:1.5rem; object-fit: contain; aspect-ratio: 1'"
                                             :gallery="'team-logo'"/>
                            </div>
                        </td>
                        <td>{{ $team->name }}</td>
                        <td class="text-center">
                            {!! is_active($team->is_active) !!}
                        </td>
                        <td class="text-right pr-5">
                            <a href="{{ route('admin.team.show', $team->id) }}"
                               class="btn btn-success">
                                {{ __('Смотреть') }}
                            </a>
                            <a href="{{ route('admin.team.edit', $team->id) }}"
                               class="btn btn-warning">
                                {{ __('Изменить') }}
                            </a>
                            <a href="javascript:void(0)"
                               onclick="openDeleteModal(this)"
                               data-id="{{ $team->id }}"
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
    <x-modals.delete-modal :action="route('admin.team.destroy', 'ID0')"/>
@endsection
