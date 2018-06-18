{{ Form::open(['url' => $route, 'method' => $method, 'id' => 'form-edit']) }}

{{ Form::hidden('id', $product->id) }}

<div class="row">
    <div class="col-lg-8">
        <div class="form-group">
            <label>{{ __('Назва:') }}</label>

            {{ Form::text('name', $product->name, [
                'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('name'))
                <span class="invalid-feedback">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('H1:') }}</label>

            {{ Form::text('h1', $product->h1, [
                'class' => 'form-control'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Опис:') }}</label>

            {{ Form::textarea('text', $product->text, [
                'class' => 'summernote'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Meta-title:') }}</label>

            {{ Form::text('meta_title', $product->meta_title, [
                'class' => $errors->has('meta_title') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('meta_title'))
                <span class="invalid-feedback">
                    {{ $errors->first('meta_title') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Meta-description:') }}</label>

            {{ Form::textarea('meta_description', $product->meta_description, [
                'class' => $errors->has('meta_description') ? 'form-control is-invalid' : 'form-control',
                'rows' => 3
            ]) }}

            @if($errors->has('meta_description'))
                <span class="invalid-feedback">
                    {{ $errors->first('meta_description') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Meta-keywords:') }}</label>

            {{ Form::textarea('meta_keywords', $product->meta_keywords, [
                'class' => $errors->has('meta_keywords') ? 'form-control is-invalid' : 'form-control',
                'rows' => 3
            ]) }}

            @if($errors->has('meta_keywords'))
                <span class="invalid-feedback">
                    {{ $errors->first('meta_keywords') }}
                </span>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label>{{ __('Аліас:') }}</label>

            {{ Form::text('slug', $product->slug, [
                'class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('slug'))
                <span class="invalid-feedback">
                    {{ $errors->first('slug') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Категорія:') }}</label>

            {{ Form::select('category[]', $categories, $product->categories()->pluck('id')->toArray(), [
                'class' => 'form-control select2',
                'multiple' => 'multiple'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Артікул:') }}</label>

            {{ Form::text('sku', $product->sku, [
                'class' => $errors->has('sku') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('sku'))
                <span class="invalid-feedback">
                    {{ $errors->first('sku') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Статус:') }}</label>

            {{ Form::select('status', \App\Product::statuses(), $product->status, [
                'class' => 'form-control'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Сортування:') }}</label>

            {{ Form::text('sort_order', $product->sort_order, [
                'class' => $errors->has('sort_order') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('slug'))
                <span class="invalid-feedback">
                    {{ $errors->first('sort_order') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Файл:') }}</label>

            <div class="input-group">
                {{ Form::text('file', request()->old('file') ?? $product->file, [
                    'class' => 'form-control',
                    'placeholder' => __('Обрати файл...')
                ]) }}

                <span class="input-group-append">
                    <button class="btn btn-primary btn-filemanager-open" type="button" data-mime-types="">
                        <i class="la la-file"></i>
                        {{ __('Обрати') }}
                    </button>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label>{{ __('Зображення:') }}</label>

            <figure>
                @if(request()->old('image') || $product->image)
                    <img class="img-fluid" src="{{ request()->old('image') ?? $product->image }}" />
                @endif
            </figure>

            <button class="btn btn-primary btn-filemanager-open" type="button" data-mime-types="image">
                <i class="la la-photo"></i>
                {{ __('Обрати') }}
            </button>

            <button class="btn btn-danger btn-remove {{ request()->old('image') || $product->image ? '' : 'd-none' }}" type="button">
                <i class="la la-remove"></i>
                {{ __('Видалити') }}
            </button>

            {{ Form::hidden('image', request()->old('image') ?? $product->image) }}
        </div>
    </div>
</div>

{{ Form::close() }}

<div class="modal fade" id="modal-filemanager" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    {{ __('Обрати файл') }}
                </h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.css') }}">
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250
            });

            $('.select2').select2();

            var data = {
                modal: 1,
                page: 1,
                mime_types: '',
                per_page: 18
            };

            $('.btn-filemanager-open').on('click', function (e) {
                e.preventDefault();

                data.mime_types = $(this).data('mime-types');

                getResponse('{{ route('admin.filemanager.index') }}', data, true);
            });

            $('.btn-remove').on('click', function (e) {
                e.preventDefault();

                $('#form-edit').find('figure').html('');
                $('.btn-filemanager-remove').addClass('d-none');
            });

            $('#modal-filemanager').on('click', '.page-item:not(.active) .page-link', function (e) {
                e.preventDefault();

                getResponse($(this).attr('href'), null, false);
            });

            $('#modal-filemanager').on('click', '.directory a', function (e) {
                e.preventDefault();

                getResponse($(this).attr('href'), data, false);
            });

            $('#modal-filemanager').on('click', '.file a', function (e) {
                e.preventDefault();

                var target = $(this).attr('href');

                if (data.mime_types == 'image') {
                    $('#form-edit').find('figure').html('<img class="img-fluid" src="' + target + '" />');
                    $('#form-edit').find('input[name="image"]').val(target);

                    $('.btn-filemanager-remove').removeClass('d-none');
                } else {
                    $('#form-edit').find('input[name="file"]').val(target);
                }

                $('#modal-filemanager').modal('hide');
            });

            $('#modal-filemanager').on('click', '.back a', function (e) {
                e.preventDefault();

                getResponse($(this).attr('href'), data, false);
            });

            function getResponse(url, data, showModal) {
                $.get(url, data, function (response) {
                    $('#modal-filemanager .modal-body').html(response);

                    if (showModal) {
                        $('#modal-filemanager').modal('show');
                    }
                });
            }
        });
    </script>
@endpush