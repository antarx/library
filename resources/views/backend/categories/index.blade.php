@extends('backend.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Категорії') }}
            <small>({{ $categories->total() }})</small>
        </h2>

        <div class="toolbar">
            <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">
                <i class="la la-plus"></i>
                {{ __('Додати') }}
            </a>
        </div>
    </div>

    {{ Form::open(['route' => 'admin.categories.index', 'method' => 'get']) }}
        @include('backend.layouts.includes.search')
    {{ Form::close() }}

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('Назва') }}</th>
                <th>{{ __('Статус') }}</th>
                <th>{{ __('Дата створення') }}</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $category)
                @include('backend.categories.includes.row')
            @endforeach
        </tbody>
    </table>

    {{ $categories->appends(request()->all())->links() }}

    @include('backend.layouts.includes.parts.status')
@endsection