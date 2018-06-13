<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Видалити') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Ви впевнені, що хочете видалити файл або папку?</p>

                {{ Form::open(['route' => 'admin.filemanager.delete', 'method' => 'delete', 'id' => 'form-delete']) }}

                {{ Form::hidden('path', request()->get('path', null)) }}
                {{ Form::hidden('name', null) }}
                {{ Form::hidden('extension', null) }}

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="la la-remove"></i>
                    {{ __('Відмінити') }}
                </button>

                <button type="submit" class="btn btn-danger" form="form-delete">
                    <i class="la la-check"></i>
                    {{ __('Видалити') }}
                </button>
            </div>
        </div>
    </div>
</div>