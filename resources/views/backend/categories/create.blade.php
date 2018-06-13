@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Категорії') }}
            <small>- {{ __('Нова') }}</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-light" href="{{ route('admin.categories.index') }}">
                <i class="la la-undo"></i>
                {{ __('Назад') }}
            </a>

            <button class="btn btn-primary" type="submit" form="form-edit">
                <i class="la la-check"></i>
                {{ __('Зберегти') }}
            </button>
        </div>
    </div>

    @include('backend.categories.includes.form', [
        'category' => $category,
        'route' => route('admin.categories.store'),
        'method' => 'post'
    ])
@endsection