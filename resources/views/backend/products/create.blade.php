@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Товар') }}
            <small>- {{ __('Новий') }}</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-light" href="{{ route('admin.products.index') }}">
                <i class="la la-undo"></i>
                {{ __('Назад') }}
            </a>

            <button class="btn btn-primary" type="submit" form="form-edit">
                <i class="la la-check"></i>
                {{ __('Зберегти') }}
            </button>
        </div>
    </div>

    @include('backend.products.includes.form', [
        'product' => $product,
        'route' => route('admin.products.store'),
        'method' => 'post'
    ])
@endsection