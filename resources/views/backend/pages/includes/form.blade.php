{{ Form::open(['url' => $route, 'method' => $method, 'id' => 'form-edit']) }}

{{ Form::hidden('id', $page->id) }}

<div class="row">
    <div class="col-lg-8">
        <div class="form-group">
            <label>{{ __('Назва:') }}</label>

            {{ Form::text('title', $page->title, [
                'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('H1:') }}</label>

            {{ Form::text('h1', $page->h1, [
                'class' => 'form-control'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Зміст:') }}</label>

            {{ Form::textarea('text', $page->text, [
                'class' => 'summernote'
            ]) }}
        </div>

        <div class="form-group">
            <label>{{ __('Meta-title:') }}</label>

            {{ Form::text('meta_title', $page->meta_title, [
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

            {{ Form::textarea('meta_description', $page->meta_description, [
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

            {{ Form::textarea('meta_keywords', $page->meta_keywords, [
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

            {{ Form::text('slug', $page->slug, [
                'class' => $errors->has('slug') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('slug'))
                <span class="invalid-feedback">
                    {{ $errors->first('slug') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Статус:') }}</label>

            {{ Form::select('status', \App\Page::statuses(), $page->status, [
                'class' => 'form-control'
            ]) }}
        </div>
    </div>
</div>

{{ Form::close() }}

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250,
            });
        });
    </script>
@endpush