@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Сторінки') }}
            <small>- {{ __('Редагування') }}</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-light" href="{{ route('admin.pages.index') }}">
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

    @include('backend.pages.includes.form', [
        'page' => $page,
        'route' => route('admin.pages.update', $page->id),
        'method' => 'put'
    ])
@endsection