@extends('admin.layouts.app')
@section('title', $player->name_initials)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ $player->full_name }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8 border-right">
                    <div class="row">
                        <div class="col-6"><h5>{{ __('Полное имя') }}</h5></div>
                        <div class="col-6"><p>{{ $player->full_name }}</p></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6"><h5>{{ __('Команда') }}</h5></div>
                        <div class="col-6">
                            <span class="mr-2">{{ $player->team->name }}</span>
                            <x-fancy-box :url="$player->team->logo?->getFullUrl()"
                                         :gallery="'team-logo'"
                                         :alt="$player->team->logo?->file_name"
                                         :css="'width:1.5rem; object-fit: contain; aspect-ratio: 1'"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6"><h5>{{ __('Номер') }}</h5></div>
                        <div class="col-6"><p>{{ $player->number }}</p></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6"><h5>{{ __('Статус') }}</h5></div>
                        <div class="col-6">
                            <p>
                                @if($player->is_active)
                                    <span class="text-success">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                @else
                                    <span class="text-danger">
                                        <i class="fas fa-times-circle"></i>
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4 d-flex justify-content-center border-left">
                    <x-fancy-box :url="$player->avatar?->getFullUrl()"
                                 :alt="$player->avatar?->file_name"
                                 :css="'width: 300px; object-fit: contain; aspect-ratio: 1'"
                                 :gallery="'avatar'"/>
                </div>
            </div>
        </div>
    </div>
@endsection
@pushonce('js')
    <script src="{{ asset('assets/dist/js/app.js') }}"></script>
@endpushonce
