{{ Form::open(['route' => ['admin.profile.update', $user->id], 'method' => 'put', 'id' => 'form-edit']) }}

<div class="row">
    <div class="col-lg-8">
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

            {{ Form::text('email', $user->email, [
                'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control'
            ]) }}

            @if($errors->has('email'))
                <span class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </span>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label>{{ __('Статус:') }}</label>

            {{ Form::select('status', \App\User::statuses(), $user->status, [
                'class' => 'form-control'
            ]) }}
        </div>
    </div>
</div>

{{ Form::close() }}