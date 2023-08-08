@extends('admin.layouts.app')
@section('title', __('Игроки'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">Игроки</h5>
        </div>
        <div class="card-body">

            <div class="my-3">
                <a href="{{ rroute('admin.player.create') }}" class="btn btn-primary">{{ __('Новый игрок') }}</a>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width:1.5rem">ID</th>
                    <th style="width:1.5rem">{{ __('Аватар') }}</th>
                    <th style="width:15rem">{{ __('ФИО') }}</th>
                    <th style="width:25rem">{{ __('Команда') }}</th>
                    <th style="width:1.5rem" class="text-center">{{ __('Номер') }}</th>
                    <th style="width:1.5rem" class="text-center">{{ __('Статус') }}</th>
                    <th class=" pr-5"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($players as $player)
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
                        <td class="text-center">{{ $player->number }}</td>
                        <td class="text-center">
                            {!! is_active($player->is_active) !!}
                        </td>
                        <td class="text-right pr-5">
                            <a href="{{ rroute('admin.player.show', $player->id) }}"
                               class="btn btn-success">
                                {{ __('Смотреть') }}
                            </a>
                            <a href="{{ rroute('admin.player.edit', $player->id) }}"
                               class="btn btn-warning">
                                {{ __('Изменить') }}
                            </a>
                            <a href="javascript:void(0)"
                               onclick="openDeleteModal(this)"
                               data-id="{{ $player->id }}"
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
    <x-modals.delete-modal :action="rroute('admin.player.destroy', 'ID0')"/>
@endsection
