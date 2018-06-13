{{ Form::open(['url' => $route, 'method' => $method, 'id' => 'form-edit']) }}

{{ Form::hidden('id', $user->id) }}

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label>{{ __('Ім\'я:') }}</label>

                {{ Form::text('name', $user->name, [
                    'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control'
                ]) }}

                @if($errors->has('name'))
                    <span class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label>{{ __('Компанія:') }}</label>

            {{ Form::text('company', $user->company, [
                'class' => $errors->has('company') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('company'))
                <span class="invalid-feedback">
                    {{ $errors->first('company') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('E-mail:') }}</label>

            {{ Form::email('email', $user->email, [
                'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('email'))
                <span class="invalid-feedback">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('Пароль:') }}</label>

            {{ Form::password('password', [
                'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control',
            ]) }}

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Пароль ще раз:') }}</label>

            {{ Form::password('password_confirmation', [
                'class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control',
            ]) }}

            @if($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>
    </div>
</div>

{{ Form::close() }}