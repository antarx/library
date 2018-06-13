@extends('frontend.layouts.profile')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Мої замовленная') }}
            <small>({{ $orders->total() }})</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-primary" href="{{ route('profile.orders.create') }}">
                <i class="la la-plus"></i>
                {{ __('Замовити') }}
            </a>
        </div>
    </div>

    @if(session()->has('success'))
        @alert(['type' => 'success'])
            {{ session('success') }}
        @endalert
    @endif

    @if($orders->count() > 0)
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
                @foreach($orders as $order)
                    @include('frontend.orders.includes.row')
                @endforeach
            </tbody>
        </table>

        {{ $orders->appends(request()->all())->links() }}
    @else
        <h5 class="text-center mb-0">У Вас не має замовлень.</h5>
        <p class="text-center">Щоб створити замовленния, натисніть на кнопку <strong>"замовити"</strong> у верхньому правому кутку.</p>
    @endif
@endsection