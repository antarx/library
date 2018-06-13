<div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-5">
    <div class="thumb mb-3">
        <a href="{{ $item->get('url') }}" target="_blank">
            <img class="img-fluid" src="{{ $item->get('image') }}">
        </a>
    </div>

    <div class="info">
        <h6 class="caption text-clip mb-0" data-toggle="dropdown">{{ $item->get('name') }}</h6>

        <span class="type small text-muted float-left">{{ $item->get('type') }}</span>

        <span class="float-right action" data-toggle="dropdown">
            <i class="la la-ellipsis-v p-0"></i>
        </span>

        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item action-rename" href="#" data-name="{{ $item->get('name') }}" data-extension="{{ $item->get('extension') }}">
                <i class="la la-pencil-square"></i>
                {{ __('Переназвати') }}
            </a>

            <a class="dropdown-item action-download" href="#" data-name="{{ $item->get('name') }}" data-extension="{{ $item->get('extension') }}">
                <i class="la la-upload"></i>
                {{ __('Вивантажити') }}
            </a>

            <a class="dropdown-item action-delete" href="#" data-name="{{ $item->get('name') }}" data-extension="{{ $item->get('extension') }}">
                <i class="la la-trash text-danger"></i>
                {{ __('Видалити') }}
            </a>
        </div>
    </div>
</div>