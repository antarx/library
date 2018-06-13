<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Завантажити') }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'admin.filemanager.upload', 'method' => 'post', 'files' => true, 'id' => 'form-upload']) }}

                {{ Form::hidden('path', request('path')) }}

                <div class="form-group">
                    <div class="custom-file">
                        <input id="custom-file" class="custom-file-input" type="file" name="file">

                        <label class="custom-file-label" for="custom-file">
                            {{ __('Оберіть файл...') }}
                        </label>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">
                    <i class="la la-remove"></i>
                    {{ __('Відмінити') }}
                </button>

                <button type="submit" class="btn btn-primary" form="form-upload" disabled="disabled">
                    <i class="la la-check"></i>
                    {{ __('Завантажити') }}
                </button>
            </div>
        </div>
    </div>
</div>