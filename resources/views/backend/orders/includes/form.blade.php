{{ Form::open(['route' => ['admin.orders.update', $order->user_id, $order->id], 'method' => 'put', 'id' => 'form-edit']) }}

<div class="row mb-5">
    <div class="col-lg-6">
        <dl class="row list-detail">
            <dt class="col-sm-6">{{ __('Номер замовлення:') }}</dt>
            <dd class="col-sm-6">{{ $order->invoice }}</dd>

            <dt class="col-sm-6">{{ __('Дата створення:') }}</dt>
            <dd class="col-sm-6">{{ $order->created_at->format('d.m.Y H:i:s') }}</dd>

            <dt class="col-sm-6">{{ __('Поточний статус:') }}</dt>
            <dd class="col-sm-6">
                {{ Form::select('status', \App\Order::statuses(), $order->status, [
                    'class' => 'form-control'
                ]) }}
            </dd>
        </dl>
    </div>
</div>

<table class="table table-category">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Категорія') }}</th>
        <th>{{ __('Дата початку:') }}</th>
        <th>{{ __('Дата кінця:') }}</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
        @if(request()->old('order'))
            @foreach(request()->old('order') as $key => $value)
                <tr>
                    <td></td>

                    <td>
                        {{ Form::select('order[' . $key . '][category_id]', $categories, $value['category_id'], [
                            'class' => $errors->has('order.' . $key . '.category_id') ? 'form-control is-invalid' : 'form-control',
                        ]) }}


                        @if($errors->has('order.' . $key . '.category_id'))
                            <span class="invalid-feedback">
                                {{ $errors->first('order.' . $key . '.category_id') }}
                            </span>
                        @endif
                    </td>

                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>

                            {{ Form::text('order[' . $key . '][date_start]', $value['date_start'], [
                                'class' => $errors->has('order.' . $key . '.date_start') ? 'form-control datepicker is-invalid' : 'form-control datepicker',
                                'autocomplete' => 'off'
                            ]) }}

                            @if($errors->has('order.' . $key . '.date_start'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('order.' . $key . '.date_start') }}
                                </span>
                            @endif
                        </div>
                    </td>

                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>

                            {{ Form::text('order[' . $key . '][date_end]', $value['date_end'], [
                                'class' => $errors->has('order.' . $key . '.date_end') ? 'form-control datepicker is-invalid' : 'form-control datepicker',
                                'autocomplete' => 'off'
                            ]) }}

                            @if($errors->has('order.' . $key . '.date_end'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('order.' . $key . '.date_end') }}
                                </span>
                            @endif
                        </div>
                    </td>

                    <td>
                        <button class="btn btn-danger btn-remove" type="button">
                            <i class="la la-remove"></i>
                            {{ __('Видалити') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        @else
            @foreach($order->categories as $key => $item)
                <tr>
                    <td></td>

                    <td>
                        {{ Form::select('order[' . $key . '][category_id]', $categories, $item->pivot->category_id, [
                            'class' => $errors->has('order.' . $key . '.category_id') ? 'form-control is-invalid' : 'form-control',
                        ]) }}
                    </td>

                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>

                            {{ Form::text('order[' . $key . '][date_start]', $item->pivot->date_start->format('d.m.Y'), [
                                'class' => $errors->has('order.' . $key . '.date_start') ? 'form-control datepicker is-invalid' : 'form-control datepicker',
                                'autocomplete' => 'off'
                            ]) }}
                        </div>
                    </td>

                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                            </div>

                            {{ Form::text('order[' . $key . '][date_end]', $item->pivot->date_end->format('d.m.Y'), [
                                'class' => $errors->has('order.' . $key . '.date_end') ? 'form-control datepicker is-invalid' : 'form-control datepicker',
                                'autocomplete' => 'off'
                            ]) }}
                        </div>
                    </td>

                    <td>
                        <button class="btn btn-danger btn-remove" type="button">
                            <i class="la la-remove"></i>
                            {{ __('Видалити') }}
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>

    <tfoot>
    <tr>
        <td class="text-right" colspan="5">
            <button class="btn btn-primary btn-add" type="button">
                <i class="la la-plus"></i>
                {{ __('Додати') }}
            </button>
        </td>
    </tr>
    </tfoot>
</table>

{{ Form::close() }}