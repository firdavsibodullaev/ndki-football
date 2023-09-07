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
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col-8 d-flex justify-content-start">
                                                            <x-fancy-box
                                                                :url="$home->team->logo?->getFullUrl()"
                                                                :alt="$home->team->logo?->file_name"
                                                                :css="'width:2rem; object-fit: contain; aspect-ratio: 1'"
                                                                :gallery="'team-logo'"/>
                                                            <span
                                                                class="ml-2 h6 mb-0">{{ $home->team->name }}</span>
                                                        </div>
                                                        <div class="col-4 text-right">{{ $game->home_goals }}</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 d-flex justify-content-start">
                                                            <x-fancy-box :url="$away->team->logo?->getFullUrl()"
                                                                         :alt="$away->team->logo?->file_name"
                                                                         :css="'width:2rem; object-fit: contain; aspect-ratio: 1'"
                                                                         :gallery="'team-logo'"/>
                                                            <span
                                                                class="ml-2 h6 mb-0">{{ $away->team->name }}</span>
                                                        </div>
                                                        <div class="col-4 text-right">{{ $game->away_goals }}</div>
                                                    </div>
                                                </div>
                                                <p class="text-center m-0 p-0">{{ __('Дата матча') }}</p>
                                                <h6 class="text-center">{{ $game->game_at->format('d.m.Y H:i') }}</h6>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            @if($game->finished_at)
                                                <button class="w-100 btn btn-secondary"
                                                        disabled>{{ __('Матч') }}</button>
                                            @else
                                                <a onclick="MatchGoals.openModal({{ $season->id }},{{ $game->id }})"
                                                   class="w-100 btn btn-secondary">{{ __('Матч') }}</a>
                                            @endif
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
                            <th class="text-left" style="min-width:300px">{{ __('Название') }}</th>
                            <th title="{{ __('Проведенные матчи') }}">{{ __('И') }}</th>
                            <th title="{{ __('Выигрыши') }}">{{ __('В') }}</th>
                            <th title="{{ __('Ничьи') }}">{{ __('Н') }}</th>
                            <th title="{{ __('Поражения') }}">{{ __('П') }}</th>
                            <th style="min-width: 50px" title="{{ __('Забитые/Пропущенные голы') }}">{{ __('З-П') }}</th>
                            <th>{{ __('Очко') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($season->seasonTeams as $team)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex h-100 align-content-center justify-content-center">
                                        <x-fancy-box :url="$team->team->logo?->getFullUrl()"
                                                     :alt="$team->team->logo?->file_name"
                                                     :css="'width:1.5rem; object-fit: contain; aspect-ratio: 1'"
                                                     :gallery="'team-logo'"/>
                                    </div>
                                </td>
                                <td class="text-left">{{ $team->team->name }}</td>
                                <td>{{ $team->rounds }}</td>
                                <td>{{ $team->victory }}</td>
                                <td>{{ $team->draw }}</td>
                                <td>{{ $team->defeat }}</td>
                                <td>{{ $team->goals_scored }}-{{ $team->goals_conceded }}</td>
                                <td class="font-weight-bold">{{ $team->points }}</td>
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
    <x-game.match-goals/>
@endsection
