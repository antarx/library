<tr>
    <td>{{ $orders->currentPage() * $loop->iteration }}</td>

    <td>{{ $order->invoice }}</td>

    <td>{!! \App\Order::htmlStatuses()[$order->status] !!}</td>

    <td>{{ $order->created_at->format('d.m.Y H:i:s') }}</td>

    <td>
        <div class="dropdown">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Обрати дію') }}
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('profile.orders.show', $order->id) }}">
                    <i class="la la-edit"></i>
                    {{ __('Переглянути') }}
                </a>
            </div>
        </div>
    </td>
</tr>