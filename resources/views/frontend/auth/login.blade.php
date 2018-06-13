@extends('frontend.layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 align-self-center">

                {{ Form::open(['route' => 'login', 'method' => 'post']) }}

                <div class="card card-default mt-5 pl-5 pr-5">
                    <div class="card-header">
                        <h2 class="card-title text-uppercase mt-4">
                            <i class="la la-user text-primary"></i>
                            {{ __('Вхід') }} /
                            <a href="{{ route('register') }}">{{ __('Реєстрація') }}</a>
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::email('email', old('email'), [
                                'class'       => $errors->has('email') ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg',
                                'placeholder' => __('E-mail')
                            ]) }}

                            @if($errors->has('email'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::password('password', [
                                'class'       => $errors->has('password') ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg',
                                'placeholder' => __('Пароль')
                            ]) }}

                            @if($errors->has('password'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <a href="{{ url('/password/reset') }}">
                                {{ __('Забули пароль?') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        {{ Form::submit(__('Увійти'), ['class' => 'btn btn-primary btn-block btn-lg text-uppercase mb-5']) }}
                    </div>
                </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
