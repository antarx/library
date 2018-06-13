@extends('frontend.layouts.profile')

@section('content')
    <div class="d-flex justify-content-between mb-5">
        <h2 class="heading-title">
            {{ __('Мій профіль') }}
        </h2>

        <div class="toolbar">
            <button class="btn btn-primary" form="form-edit">
                <i class="la la-check"></i>
                {{ __('Зберегти') }}
            </button>
        </div>
    </div>

    @if(session()->has('message'))
        @alert(['type' => 'success'])
            {{ session('message') }}
        @endalert
    @endif

    @include('frontend.user.includes.form', [
        'user' => $user,
        'route' => route('profile.user.update'),
        'method' => 'put'
    ])
@endsection