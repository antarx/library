@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Користувачі') }}
            <small>({{ $users->total() }})</small>
        </h2>
    </div>

    {{ Form::open(['route' => 'admin.users.index', 'method' => 'index']) }}
        @include('backend.layouts.includes.search')
    {{ Form::close() }}

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('І\'мя') }}</th>
                <th>{{ __('E-mail') }}</th>
                <th>{{ __('IP-адреса') }}</th>
                <th>{{ __('Статус') }}</th>
                <th>{{ __('Дата реєстрації') }}</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                @include('backend.users.includes.row')
            @endforeach
        </tbody>
    </table>

    {{ $users->appends(request()->all())->links() }}

    @include('backend.layouts.includes.parts.status')

    <!-- Modal Mail -->
    <div class="modal fade" id="modal-mail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Надіслати листа') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open([]) }}

                    <div class="form-group">
                        <label>{{ __('Тема:') }}</label>

                        {{ Form::text('subject', null, [
                            'class' => 'form-control'
                        ]) }}
                    </div>

                    <div class="form-group">
                        <label>{{ __('Зміст:') }}</label>

                        {{ Form::textarea('message', null, [
                            'class' => 'form-control',
                            'rows' => 5
                        ]) }}
                    </div>

                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">
                        <i class="la la-remove"></i>
                        {{ __('Скасувати') }}
                    </button>

                    <button type="button" class="btn btn-primary">
                        <i class="la la-check"></i>
                        {{ __('Надіслати') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Видалити користувача') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Ви впевнені?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light">
                        <i class="la la-remove"></i>
                        {{ __('Видалити') }}
                    </button>

                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="la la-check"></i>
                        {{ __('Скасувати') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection