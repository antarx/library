@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Користувач') }}
            <small>- {{ __('Замовлення') }}</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-light" href="{{ route('admin.users.index') }}">
                <i class="la la-undo"></i>
                {{ __('Назад') }}
            </a>
        </div>
    </div>

    @if(session()->has('success'))
        @alert(['type' => 'success'])
            {{ session('success') }}
        @endalert
    @endif

    @include('backend.layouts.includes.parts.nav')

    {{ Form::open(['route' => ['admin.orders.index', $user->id], 'method' => 'get']) }}
        @include('backend.layouts.includes.search')
    {{ Form::close() }}

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Номер замовлення') }}</th>
            <th>{{ __('Статус') }}</th>
            <th>{{ __('Дата створення') }}</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
            @foreach($user->orders as $order)
                @include('backend.orders.includes.row')
            @endforeach
        </tbody>
    </table>

    {{ $orders->appends(request()->all())->links() }}

    @include('backend.layouts.includes.parts.status')

    <!-- Modal Delete -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Видалити замовлення') }}</h5>
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