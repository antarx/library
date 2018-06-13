@extends('backend.layouts.admin')

@section('content')
    @include('backend.dashboard.includes.users')

    @include('backend.dashboard.includes.orders')
@endsection