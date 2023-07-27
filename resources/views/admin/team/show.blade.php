@extends('admin.layouts.app')
@section('title', $team->name)
@section('content')
    <div class="d-flex flex-column-reverse flex-md-row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

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
            </div>
        </div>
    </div>
@endsection
