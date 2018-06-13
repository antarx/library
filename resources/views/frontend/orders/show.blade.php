@extends('frontend.layouts.profile')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Мої замовленная') }}
            <small>- {{ __('Перегляд') }}</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-light" href="{{ route('profile.orders.index') }}">
                <i class="la la-undo"></i>
                {{ __('Назад') }}
            </a>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6">
            <dl class="row list-detail">
                <dt class="col-sm-6">{{ __('Номер замовлення:') }}</dt>
                <dd class="col-sm-6">{{ $order->invoice }}</dd>

                <dt class="col-sm-6">{{ __('Дата створення:') }}</dt>
                <dd class="col-sm-6">{{ $order->created_at->format('d.m.Y H:i:s') }}</dd>

                <dt class="col-sm-6">{{ __('Поточний статус:') }}</dt>
                <dd class="col-sm-6">{!! \App\Order::htmlStatuses()[$order->status] !!}</dd>
            </dl>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-category">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Категорія') }}</th>
                        <th>{{ __('Дата початку:') }}</th>
                        <th>{{ __('Дата кінця:') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($order->categories as $category)
                        <tr>
                            <td></td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->pivot->date_start->format('d.m.Y') }}</td>
                            <td>{{ $category->pivot->date_end->format('d.m.Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection