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
                    <h5><strong>{{ __('Турнир') }}:</strong> {{ $season->tournament->name }}</h5>
                    <h5><strong>{{ __('Годы') }}:</strong> {{ $season->dates }}</h5>
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
            <div class="card">
                <div class="card-header bg-gradient-success">
                    <div class="card-title">Матчи</div>
                </div>
                <div class="card-body" style="overflow-y: auto">
                    @foreach($season->games->groupBy('round')->sort() as $round => $games)
                        <div class="h4 text-center">{{ __('Тур', ['round' => $round]) }}</div>
                        <div class="row">
                            @foreach($games as $game)
                                @php($home = $game->home)
                                @php($away = $game->away)
                                <div class="col-6 my-2">
                                    <div class="card bg-gradient-dark">
                                        <div class="card-body">
                                            <div class="px-2 py-3">
                                                <div
                                                    class="d-flex h-100 align-items-center align-content-center justify-content-center mb-3">
                                                    <x-fancy-box :url="$home->team->logo->getFullUrl()"
                                                                 :alt="$home->team->logo->file_name"
                                                                 :css="'width:2rem; object-fit: contain; aspect-ratio: 1'"
                                                                 :gallery="'team-logo'"/>
                                                    <span class="mr-3 ml-1 h6 mb-0">{{ $home->team->name }}</span>

                                                    <span
                                                        class="h6 mb-0">{{ $game->home_goals }} : {{ $game->away_goals }}</span>

                                                    <span class="ml-3 mr-1 h6 mb-0">{{ $away->team->name }}</span>
                                                    <x-fancy-box :url="$away->team->logo->getFullUrl()"
                                                                 :alt="$away->team->logo->file_name"
                                                                 :css="'width:2rem; object-fit: contain; aspect-ratio: 1'"
                                                                 :gallery="'team-logo'"/>
                                                </div>
                                                <p class="text-center m-0 p-0">{{ __('Дата матча') }}</p>
                                                <h6 class="text-center">{{ $game->game_at->format('d.m.Y H:i') }}</h6>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('admin.season.game.show', ['season' => $season->id, 'game' => $game->id]) }}"
                                               class="w-100 btn btn-secondary">{{ __('Матч') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
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
