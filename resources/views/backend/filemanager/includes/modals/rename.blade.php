<div class="modal fade" id="modal-rename" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Переназвати') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'admin.filemanager.rename', 'method' => 'put', 'id' => 'form-rename']) }}

                {{ Form::hidden('path', request()->get('path', null)) }}
                {{ Form::hidden('old_name', null) }}
                {{ Form::hidden('extension', null) }}

                <div class="form-group">
                    {{ Form::text('new_name', null, [
                        'class' => 'form-control'
                    ]) }}
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">
                    <i class="la la-remove"></i>
                    {{ __('Відмінити') }}
                </button>

                <button type="submit" class="btn btn-primary" form="form-rename">
                    <i class="la la-check"></i>
                    {{ __('Переназвати') }}
                </button>
            </div>
        </div>
    </div>
</div>