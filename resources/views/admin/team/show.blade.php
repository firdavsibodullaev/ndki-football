@extends('admin.layouts.app')
@section('title', $team->name)
@section('content')
    <div class="d-flex flex-column-reverse flex-md-row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Аватар') }}</th>
                            <th>{{ __('ФИО') }}</th>
                            <th>{{ __('Команда') }}</th>
                            <th>{{ __('Номер') }}</th>
                            <th>{{ __('Статус') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($team->players as $player)
                            <tr>
                                <td>{{ $player->id }}</td>
                                <td>
                                    <div class="d-flex h-100 align-content-center justify-content-center">
                                        <x-fancy-box :url="$player->avatar?->getFullUrl()"
                                                     :alt="$player->avatar?->file_name"
                                                     :css="'width:1.5rem; object-fit: contain; aspect-ratio: 1'"
                                                     :gallery="'team-logo'"/>
                                    </div>
                                </td>
                                <td>{{ $player->name_initials }}</td>
                                <td>{{ $player->team->name }}</td>
                                <td>{{ $player->number }}</td>
                                <td>
                                    @if($player->is_active)
                                        <span class="text-success">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                    @else
                                        <span class="text-danger">
                                    <i class="fas fa-times-circle"></i>
                                </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ rroute('admin.player.show', $player->id) }}"
                                       class="btn btn-success">
                                        {{ __('Смотреть') }}
                                    </a>
                                    <a href="{{ rroute('admin.player.edit', $player->id) }}?from=team-show&id={{ $team->id }}"
                                       class="btn btn-warning">
                                        {{ __('Изменить') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">{{ $team->name }}</h5>
                    <div class="d-flex justify-content-center text-center">
                        <x-fancy-box :url="$team->logo->getFullUrl()"
                                     :alt="$team->logo->file_name"
                                     :css="'width:50%; object-fit: contain; aspect-ratio: 1'"
                                     :gallery="'team-logo'"/>
                    </div>
                    <p>
                        <span class="h5">Статус:</span>
                        <span class="text-bold text-uppercase">
                            {{ $team->is_active ? __("Активный") : __("Неактивный")}}
                        </span>
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ rroute('admin.team.edit', $team->id) }}?from=team-show"
                       class="btn btn-warning mr-1">
                        {{ __('Изменить') }}
                    </a>
                    <a href="javascript:void(0)"
                       onclick="openDeleteModal(this)"
                       data-id="{{ $team->id }}"
                       class="btn btn-danger">
                        {{ __('Удалить') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-modals.delete-modal :action="rroute('admin.team.destroy', 'ID0')"/>
@endsection
