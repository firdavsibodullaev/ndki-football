@extends('admin.layouts.app')
@section('title', 'Сезон ' . $season->years)
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ $season->name }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Годы:</strong> {{ $season->dates }}</p>
        </div>
    </div>
@endsection
