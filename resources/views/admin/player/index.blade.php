@extends('admin.layouts.app')
@section('title', __('Игроки'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">Игроки</h5>
        </div>
        <div class="card-body">

            <div class="my-3">
                <a href="{{ route('admin.player.create') }}" class="btn btn-primary">{{ __('Новый игрок') }}</a>
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
                @foreach($players as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>
                            <div class="d-flex h-100 align-content-center justify-content-center">
                                <x-fancy-box :url="$team->avatar?->getFullUrl()"
                                             :alt="$team->avatar?->file_name"
                                             :css="'width:1.5rem; object-fit: contain; aspect-ratio: 1'"
                                             :gallery="'team-logo'"/>
                            </div>
                        </td>
                        <td>{{ $team->name_initials }}</td>
                        <td>{{ $team->team->name }}</td>
                        <td class="text-center">{{ $team->number }}</td>
                        <td class="text-center">
                            @if($team->is_active)
                                <span class="text-success">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                            @else
                                <span class="text-danger">
                                    <i class="fas fa-times-circle"></i>
                                </span>
                            @endif
                        </td>
                        <td class="text-right pr-5">
                            <a href="{{ route('admin.player.show', $team->id) }}"
                               class="btn btn-success">
                                {{ __('Смотреть') }}
                            </a>
                            <a href="{{ route('admin.player.edit', $team->id) }}"
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
    <x-modals.delete-modal :action="route('admin.player.destroy', 'ID0')"/>
@endsection
@pushonce('js')
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpushonce
