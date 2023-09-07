@extends('admin.layouts.app')
@section('title', __('Пользователи'))
@section('content')
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h5 class="card-title">{{ __('Пользователи') }}</h5>
        </div>
        <div class="card-body">

            <div class="my-3">
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary">{{ __('Новый пользователь') }}</a>
            </div>

            <table class="table table-striped text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Имя') }}</th>
                    <th>{{ __('Роль') }}</th>
                    <th>{{ __('Логин') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->translate() }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <a href="{{ route('admin.user.edit', $user->id) }}"
                               class="btn btn-warning">{{ __('Изменить') }}
                            </a>
                            @if(auth()->id() === $user->id)
                                <button disabled
                                        title="{{ __('Текущий пользователь') }}"
                                        class="btn btn-danger">
                                    {{ __('Удалить') }}
                                </button>
                            @else
                                <a href="javascript:void(0)"
                                   onclick="openDeleteModal(this)"
                                   data-id="{{ $user->id }}"
                                   class="btn btn-danger">
                                    {{ __('Удалить') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-modals.delete-modal :action="route('admin.user.destroy', 'ID0')"/>
@endsection
