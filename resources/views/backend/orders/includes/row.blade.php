<tr>
    <td>{{ $orders->currentPage() * $loop->iteration }}</td>

    <td>{{ $order->invoice }}</td>

    <td>
        <div class="dropdown dropdown-status">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {!! \App\Order::htmlStatuses()[$order->status] !!}
            </a>

            <div class="dropdown-menu">
                @foreach(\App\Order::htmlStatuses() as $id => $status)
                    <a class="dropdown-item" href="{{ route('admin.orders.status', [$order->user_id, $order->id]) }}" data-status="{{ $id }}">{!! $status !!}</a>
                @endforeach
            </div>
        </div>
    </td>

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