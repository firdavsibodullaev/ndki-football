@extends('admin.layouts.app')
@section('title', 'Сезон ' . $season->years)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ $season->name }}</h5>
        </div>
        <div class="card-body">
            <p><strong>{{ __('Годы') }}:</strong> {{ $season->dates }}</p>
            <button class="btn btn-primary"
                    onclick=""
            >{{ __('Добавить команды для сезона') }}</button>
        </div>
    </div>
    <x-modals.season-team-modal :teams="$teams"/>
@endsection
