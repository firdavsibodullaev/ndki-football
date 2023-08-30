@extends('admin.layouts.app')
@section('title', $season->name . " | " . $game->home_away)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Матч') }}</h5>
        </div>
        <div class="card-body">
            <h5 class="mb-3"><strong>{{ __('Статус') }}:</strong> {{ $game->status->translate() }}</h5>
            <h5><strong>{{ __('Дата') }}:</strong> {{ $game->game_at->format('d.m.Y H:i') }}</h5>
            @if($game->status->isPending())
                <button class="btn btn-primary"
                        onclick="GameStart.openModal()">{{ __('Начать матч') }}</button>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-gradient-primary">
                    <h5 class="card-title">{{ __('Состав') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 text-center border-right">
                            <h4 class="border-bottom mb-3"><strong>{{ $game->home->team->name }}</strong></h4>
                            @foreach($game->home->players as $player)
                                <h5 class="border shadow-sm py-2 px-4 position-relative">
                                    {{ $player->player->name_initials }}
                                    <span class="ml-4 position-absolute"
                                          style="right: 1.5rem">{{ $player->player->number }}</span>
                                </h5>
                            @endforeach
                        </div>
                        <div class="col-6 text-center border-left">
                            <h4 class="border-bottom mb-3"><strong>{{ $game->away->team->name }}</strong></h4>
                            @foreach($game->away->players as $player)
                                <h5 class="border shadow-sm py-2 px-4 position-relative">
                                    <span class="mr-4 position-absolute"
                                          style="left:1.5rem">{{ $player->player->number }}</span>
                                    {{ $player->player->name_initials }}
                                </h5>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button"
                                class="btn btn-primary">{{ __('Замена') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-game.replace-player/>
    @if($game->status->isPending())
        <x-game.start-game :game="$game"/>
    @endif
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpush
