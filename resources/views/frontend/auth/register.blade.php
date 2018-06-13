@extends('frontend.layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 align-self-center">

                {{ Form::open(['route' => 'register', 'method' => 'post']) }}

                <div class="card card-default mt-5 pl-5 pr-5">
                    <div class="card-header">
                        <h2 class="card-title text-uppercase mt-4">
                            <i class="la la-user text-primary"></i>
                            {{ __('Реєстрація') }} /
                            <a href="{{ route('login') }}">{{ __('Вхід') }}</a>
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::text('name', old('name'), [
                                'class'       => $errors->has('name') ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg',
                                'placeholder' => __('Ім\'я')
                            ]) }}

                            @if($errors->has('name'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::text('company', old('company'), [
                                'class'       => $errors->has('company') ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg',
                                'placeholder' => __('Організація')
                            ]) }}

                            @if($errors->has('company'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </span>
                            @endif
                        </div>

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

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::password('password_confirmation', [
                                'class'       => $errors->has('password_confirmation') ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg',
                                'placeholder' => __('Пароль ще раз')

                            ]) }}

                            @if($errors->has('password_confirmation'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::text('ip', old('ip'), [
                                'class'       => $errors->has('ip') ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg',
                                'placeholder' => __('IP-адреса')
                            ]) }}

                            @if($errors->has('ip'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('ip') }}
                                </span>
                            @endif

                            <span class="text-muted small">
                                {{ __('Якщо потрібно додати декілька IP-адресів, розділіть їх комою з крапкою, напрклад') }}:
                                <em class="text-primary">192.0.0.1; 192.0.0.2</em>
                            </span>
                        </div>
                    </div>

                    <div class="card-footer">
                        {{ Form::submit(__('Зареєструватися'), ['class' => 'btn btn-primary btn-block btn-lg text-uppercase mb-5']) }}
                    </div>
                </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
