<tr>
    <td>{{ $products->currentPage() * $loop->iteration }}</td>
    <td>
        <h6 class="my-0">{{ $product->name }}</h6>
        <span class="small text-muted">{{ $product->sku }}</span>
    </td>
    <td>
        <div class="dropdown dropdown-status">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {!! \App\Product::htmlStatuses()[$product->status] !!}
            </a>

            <div class="dropdown-menu">
                @foreach(\App\Product::htmlStatuses() as $id => $status)
                    <a class="dropdown-item" href="{{ route('admin.products.status', $product->id) }}" data-status="{{ $id }}">{!! $status !!}</a>
                @endforeach
            </div>
        </div>
    </td>
    <td>{{ $product->created_at }}</td>
    <td>
        <div class="dropdown">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Обрати дію') }}
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.products.edit', $product->id) }}">
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