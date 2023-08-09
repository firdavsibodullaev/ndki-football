@extends('admin.layouts.app')
@section('title', 'Сезон ' . $season->years)
@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title">{{ $season->name }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>{{ __('Годы') }}:</strong> {{ $season->dates }}</p>
                    @if($season->seasonTeams->count() == 0)
                        <button class="btn btn-primary"
                                onclick="SeasonTeam.openModal()"
                        >{{ __('Добавить команды для сезона') }}</button>
                    @endif
                    @if($season->seasonTeams->count() > 0 && $season->games->count() === 0)
                        <button onclick="Game.openModal()"
                                class="btn btn-primary"
                        >{{ __('Распределить матчи') }}</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-gradient-cyan">
                    <h5 class="card-title">{{ __('Турнирная таблица') }}</h5>
                </div>
                <div class="card-body" style="overflow-x: auto">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th style="width:1.5rem">#</th>
                            <th style="width:1.5rem">{{ __('Лого') }}</th>
                            <th style="width:15rem">{{ __('Название') }}</th>
                            <th class="text-right">{{ __('Очко') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($season->seasonTeams as $team)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex h-100 align-content-center justify-content-center">
                                        <x-fancy-box :url="$team->team->logo->getFullUrl()"
                                                     :alt="$team->team->logo->file_name"
                                                     :css="'width:1.5rem; object-fit: contain; aspect-ratio: 1'"
                                                     :gallery="'team-logo'"/>
                                    </div>
                                </td>
                                <td>{{ $team->team->name }}</td>
                                <td class="text-right">{{ $team->points }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if($season->seasonTeams->count() == 0)
        <x-modals.season-team-modal :season="$season"/>
    @endif
    @if($season->seasonTeams->count() > 0 && $season->games->count() === 0)
        <x-modals.game-modal :season="$season"/>
    @endif
@endsection
