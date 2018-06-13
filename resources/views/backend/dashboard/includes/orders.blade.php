<h3 class="mb-5">{{ __('Нові замовлення') }}</h3>

<table class="table mb-5">
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
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $order->invoice }}</td>

                <td>{!! \App\Order::htmlStatuses()[$order->status] !!}</td>

                <td>{{ $order->created_at->format('d.m.Y H:i:s') }}</td>

                <td>
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Обрати дію') }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.orders.edit', [$order->user_id, $order->id]) }}">
                                <i class="la la-edit"></i>
                                {{ __('Редагувати') }}
                            </a>

                            <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#modal-delete">
                                <i class="la la-trash text-danger"></i>
                                {{ __('Видалити') }}
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>