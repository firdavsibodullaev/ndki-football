@extends('admin.layouts.app')
@section('title', __('Сезоны'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">Сезоны</h5>
        </div>
        <div class="card-body">

            <div class="my-3">
                <a href="{{ route('admin.season.create') }}" class="btn btn-primary">{{ __('Новый сезон') }}</a>
            </div>

            <table class="table table-striped text-center">
                <thead>
                <tr>
                    <th style="width:1.5rem">ID</th>
                    <th>{{ __('Название') }}</th>
                    <th>{{ __('Даты') }}</th>
                    <th>{{ __('Текущий сезон') }}</th>
                    <th style="width: 25rem;" class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($seasons as $season)
                    <tr>
                        <td>{{ $season->id }}</td>
                        <td>{{ $season->name }}</td>
                        <td>{{ $season->dates }}</td>
                        <td>{!! is_active($season->is_current) !!}</td>
                        <td style="width: 25rem;" class="text-center">
                            <a href="{{ route('admin.season.show', $season->id) }}"
                               class="btn btn-success">
                                {{ __('Смотреть') }}
                            </a>
                            <a href="{{ route('admin.season.edit', $season->id) }}"
                               class="btn btn-warning">
                                {{ __('Изменить') }}
                            </a>
                            <a href="javascript:void(0)"
                               onclick="openDeleteModal(this)"
                               data-id="{{ $season->id }}"
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
    <x-modals.delete-modal :action="route('admin.season.destroy', 'ID0')"/>
@endsection
