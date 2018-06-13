@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Замовлення') }}
            <small>- {{ __('Редагування') }}</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-light" href="{{ route('admin.orders.index', [$order->user_id, $order->id]) }}">
                <i class="la la-undo"></i>
                {{ __('Назад') }}
            </a>

            <button class="btn btn-primary" type="submit" form="form-edit">
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

    @if($errors->has('order'))
        @alert(['type' => 'danger'])
            {{ __('order.empty') }}
        @endalert
    @endif

    @include('backend.orders.includes.form')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/css/datepicker.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/datepicker/js/datepicker.min.js') }}"></script>
    <script type="text/javascript">
        function initDatepicker() {
            $('.datepicker').datepicker({
                daysMin: ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                format: 'dd.mm.yyyy',
                monthsShort: ['Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'],
                startDate: new Date(),
                weekStart: 1
            });
        }

        initDatepicker();

        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();

            var html = '',
                i = $('.table-category tbody tr').length;

            html += '<tr>';
            html += '<td></td>';
            html += '<td>';
            html += '<select class="form-control" name="order[' + i + '][category_id]">';

            @foreach($categories as $id => $category)
                html += '<option value="{{ $id }}">{{ $category }}</option>';
            @endforeach

            html += '</select>';
            html += '</td>';
            html += '<td>';
            html += '<div class="input-group">';
            html += '<div class="input-group-prepend">';
            html += '<span class="input-group-text"><i class="la la-calendar"></i></span>';
            html += '</div>';
            html += '<input class="form-control datepicker" name="order[' + i + '][date_start]" autocomplete="off">';
            html += '</div>';
            html += '</td>';
            html += '<td>';
            html += '<div class="input-group">';
            html += '<div class="input-group-prepend">';
            html += '<span class="input-group-text"><i class="la la-calendar"></i></span>';
            html += '</div>';
            html += '<input class="form-control datepicker" name="order[' + i + '][date_end]" autocomplete="off">';
            html += '</div>';
            html += '</td>';
            html += '<td><button class="btn btn-danger btn-remove" type="button"><i class="la la-remove"></i> {{ __('Видалити') }}</button></td>';
            html += '</tr>';

            $('.table-category tbody').append(html);

            initDatepicker();
        });

        $(document).on('click', '.btn-remove', function (e) {
            e.preventDefault();

            $(this).closest('tr').remove();
        });
    </script>
@endpush