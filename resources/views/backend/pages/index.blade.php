@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Сторінки') }}
            <small>({{ $pages->total() }})</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-primary" href="{{ route('admin.pages.create') }}">
                <i class="la la-plus"></i>
                {{ __('Додати') }}
            </a>
        </div>
    </div>

    {{ Form::open(['route' => 'admin.pages.index', 'method' => 'get']) }}
        @include('backend.layouts.includes.search')
    {{ Form::close() }}

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Сторінка') }}</th>
                <th>{{ __('Статус') }}</th>
                <th>{{ __('Дата створення') }}</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($pages as $page)
                @include('backend.pages.includes.row')
            @endforeach
        </tbody>
    </table>

    {{ $pages->appends(request()->all())->links() }}

    @include('backend.layouts.includes.parts.status')
@endsection