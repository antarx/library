{{ Form::open(['method' => 'put', 'id' => 'form-status']) }}
    {{ Form::hidden('status_id', null) }}
{{ Form::close() }}

@push('scripts')
    <script type="text/javascript">
        $('.dropdown-status .dropdown-item').on('click', function(e) {
            e.preventDefault();

            var form = $('#form-status');

            form.attr('action', $(this).attr('href'));
            form.find('input[name="status_id"]').val($(this).data('status'));
            form.submit();
        });
    </script>
@endpush