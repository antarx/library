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

            {{ Form::text('sku', $product->slug, [
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
            <label>{{ __('Зображення:') }}</label>

            <figure></figure>

            <button class="btn btn-primary btn-filemanager" type="button">
                <i class="la la-photo"></i>
                {{ __('Вибрати') }}
            </button>
        </div>
    </div>
</div>

{{ Form::close() }}

<div id="modal-filemanager" class="filemanager">
    <div class="filemanager-header">
        <h4 class="heading-title">
            {{ __('Файловий менеджер') }}
        </h4>

        <button type="button" class="close" data-dismiss="filemanager" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="filemanager-body">
        <filemanager-component></filemanager-component>
    </div>
    <div class="filemanager-footer"></div>
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

            $('.btn-filemanager').on('click', function () {
                filemanager.init();

                $('#modal-filemanager').addClass('active');
                $('body').css('overflow-y', 'hidden');
            });

            $('button[data-dismiss="filemanager"]').on('click', function () {
                $('#modal-filemanager').removeClass('active');
                $('body').css('overflow-y', 'auto');
            });

            var filemanager = {
                data: {
                    page: 1
                },
                init: function () {
                    $.get('{{ route('admin.filemanager.index') }}', filemanager.data, function (response) {
                        $('.filemanager-body').html(response);
                    });
                }
            }
        });
    </script>
@endpush