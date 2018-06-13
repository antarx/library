<tr>
    <td>{{ $categories->currentPage() * $loop->iteration }}</td>
    <td>
        <h6 class="my-0">{{ $category->name }}</h6>
    </td>
    <td>
        <div class="dropdown dropdown-status">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {!! \App\Category::htmlStatuses()[$category->status] !!}
            </a>

            <div class="dropdown-menu">
                @foreach(\App\Category::htmlStatuses() as $id => $status)
                    <a class="dropdown-item" href="{{ route('admin.categories.status', $category->id) }}" data-status="{{ $id }}">{!! $status !!}</a>
                @endforeach
            </div>
        </div>
    </td>
    <td>{{ $category->created_at->format('d/m/Y H:i:s') }}</td>
    <td>
        <div class="dropdown dropdown-action">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Обрати дію') }}
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}">
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