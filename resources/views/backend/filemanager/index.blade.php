@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Файловий менеджер') }}
            <small>({{ $items->total() }})</small>
        </h2>

        <div class="toolbar">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-upload">
                <i class="la la-download"></i>
                {{ __('Завантажити') }}
            </button>
        </div>
    </div>

    @if(session()->has('success'))
        @alert(['type' => 'success'])
            {{ session('success') }}
        @endalert
    @endif

    @if(session()->has('error'))
        @alert(['type' => 'danger'])
            {{ session('error') }}
        @endalert
    @endif

    <div class="mb-5">
        {{ Form::open(['url' => route('admin.filemanager.store'), 'method' => 'post', 'id' => 'form-create']) }}

        {{ Form::hidden('path', request()->get('path', null)) }}


        <div class="input-group">
            {{ Form::text('name', null, [
                'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control',
                'placeholder' => __('Введіть назву...')
            ]) }}

            <span class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="la la-plus"></i>
                    {{ __('Нова папка') }}
                </button>
            </span>

            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>




        {{ Form::close() }}
    </div>

    <div class="row">
        @if($isSubDirectory)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5">
                <a href="{{ urldecode($back) }}">
                    <div class="thumb mb-3">
                        <img class="img-fluid" src="{{ asset('images/filemanager/back.png') }}">
                    </div>
                </a>

                <div class="info">
                    <h6 class="caption text-clip mb-0">{{ __('Назад') }}</h6>
                </div>
            </div>
        @endif

        @foreach($items as $item)
            @if($item->get('isDirectory'))
                @include('backend.filemanager.includes.directory')
            @else
                @include('backend.filemanager.includes.file')
            @endif
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $items->appends(request()->all())->links() }}
    </div>

    @include('backend.filemanager.includes.modals.upload')
    @include('backend.filemanager.includes.modals.rename')
    @include('backend.filemanager.includes.modals.delete')

    {{ Form::open(['route' => 'admin.filemanager.download', 'method' => 'post', 'id' => 'form-download']) }}

    {{ Form::hidden('path', request()->get('path', null)) }}
    {{ Form::hidden('name', null) }}
    {{ Form::hidden('extension', null) }}

    {{ Form::close() }}
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.action-rename').on('click', function (e) {
            e.preventDefault();

            var name = $(this).data('name'),
                extension = $(this).data('extension');

            if (name) {
                $('#form-rename').find('input[name="new_name"]').val(name);
                $('#form-rename').find('input[name="old_name"]').val(name);
                $('#form-rename').find('input[name="extension"]').val(extension);

                $('#modal-rename').modal('show');
            }
        });

        $('.action-download').on('click', function (e) {
            e.preventDefault();

            var name = $(this).data('name'),
                extension = $(this).data('extension');

            if (name && extension) {
                $('#form-download').find('input[name="name"]').val(name);
                $('#form-download').find('input[name="extension"]').val(extension);

                $('#form-download').submit();
            }
        });

        $('.action-delete').on('click', function (e) {
            e.preventDefault();

            var name = $(this).data('name'),
                extension = $(this).data('extension');

            if (name) {
                $('#form-delete').find('input[name="name"]').val(name);
                $('#form-delete').find('input[name="extension"]').val(extension);

                $('#modal-delete').modal('show');
            }
        });

        $('.custom-file-input').on('change', function () {
            if ($(this)[0].files.length > 0) {
                $('.custom-file-label').html($(this)[0].files[0].name);

                $('#modal-upload').find(':submit').attr('disabled', false);
            }
        });
    </script>
@endpush