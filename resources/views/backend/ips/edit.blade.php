@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Користувач') }}
            <small>- {{ __('IP-адреси') }}</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-light" href="{{ route('admin.users.index') }}">
                <i class="la la-undo"></i>
                {{ __('Назад') }}
            </a>

            <button class="btn btn-primary" form="form-edit">
                <i class="la la-check"></i>
                {{ __('Зберегти') }}
            </button>
        </div>
    </div>

    @if(session()->has('success'))
        @alert(['type' => 'success'])
            {{ session('success') }}
        @endalert
    @endif

    @include('backend.layouts.includes.parts.nav')

    @include('backend.ips.includes.form')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();

            var el = $(this).closest('.form-group').find('.form-control'),
                ip = el.val(),
                regex = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/g,
                html = '';

            el.removeClass('is-invalid');

            html += '<div class="form-group">';
            html += '<div class="input-group">';
            html += '<input class="form-control" name="ip[]" type="text" value="' + ip +'">';
            html += '<div class="input-group-append">';
            html += '<button class="btn btn-danger btn-remove" type="button">';
            html += '<i class="la la-remove"></i> {{ __('Видалити') }}';
            html += '</button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            if (regex.test(ip)) {
                $('.list-ip').append(html);

                el.val('');
            } else {
                el.addClass('is-invalid');
            }
        });

        $(document).on('click', '.btn-remove', function (e) {
            e.preventDefault();

            $(this).closest('.form-group').remove();
        });
    </script>
@endpush