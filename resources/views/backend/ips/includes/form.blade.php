{{ Form::open(['route' => ['admin.ips.update', $user->id], 'method' => 'put', 'id' => 'form-edit']) }}

<div class="row">
    <div class="col-md-8 col-12 list-ip">
        <label>{{ __('IP-адреси:') }}</label>

        @foreach($user->ip as $ip)
            <div class="form-group">
                <div class="input-group">
                    {{ Form::text('ip[]', $ip, [
                        'class' => 'form-control'
                    ]) }}

                    <div class="input-group-append">
                        <button class="btn btn-danger btn-remove" type="button">
                            <i class="la la-remove"></i>
                            {{ __('Видалити') }}
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group">
            <label>{{ __('IP-адрес:') }}</label>

            <div class="input-group">
                {{ Form::text('', null, [
                    'class' => 'form-control',
                    'placeholder' => 'XXX.XXX.XXX.XXX'
                ]) }}

                <div class="input-group-append">
                    <button class="btn btn-primary btn-add" type="button">
                        <i class="la la-plus"></i>
                        {{ __('Додати') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{ Form::close() }}