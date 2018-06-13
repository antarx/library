{{ Form::open(['url' => $route, 'method' => $method, 'id' => 'form-edit']) }}

{{ Form::hidden('id', $category->id) }}

<div class="row">
    <div class="col-lg-8">
        <div class="form-group">
            <label>{{ __('Назва:') }}</label>
            {{ Form::text('name', $category->name, [
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
            {{ Form::text('h1', $category->h1, [
                'class' => 'form-control'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Опис:') }}</label>
            {{ Form::textarea('text', $category->text, [
                'class' => 'summernote'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Meta-title:') }}</label>
            {{ Form::text('meta_title', $category->meta_title, [
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
            {{ Form::textarea('meta_description', $category->meta_description, [
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
            {{ Form::textarea('meta_keywords', $category->meta_keywords, [
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
            {{ Form::text('slug', $category->slug, [
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

            {{ Form::select('parent_id', array_merge(['0' => 'Немає'], $categories), $category->parent_id, [
                'class' => 'form-control select2'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Статус:') }}</label>

            {{ Form::select('status', \App\Category::statuses(), $category->status, [
                'class' => 'form-control'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Сортування:') }}</label>

            {{ Form::number('sort_order', $category->sort_order, [
                'class' => $errors->has('sort_order') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('sort_order'))
                <span class="invalid-feedback">
                    {{ $errors->first('sort_order') }}
                </span>
            @endif
        </div>
    </div>
</div>

{{ Form::close() }}

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
                focus: true,
                height: 250
            });

            $('.select2').select2();
        });
    </script>
@endpush