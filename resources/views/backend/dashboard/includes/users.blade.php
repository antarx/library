<h3 class="mb-5">{{ __('Нові користувачі') }}</h3>

<table class="table mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('І\'мя') }}</th>
            <th>{{ __('E-mail') }}</th>
            <th>{{ __('IP-адреса') }}</th>
            <th>{{ __('Статус') }}</th>
            <th>{{ __('Дата реєстрації') }}</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $user->name }}</td>

                <td>
                    <a href="#" role="button" data-toggle="modal" data-target="#modal-mail">{{ $user->email }}</a></td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $user->ip[0] }}
                        </a>

                        <div class="dropdown-menu">
                            @foreach($user->ip as $ip)
                                <a class="dropdown-item" href="#">{{ $ip }}</a>
                            @endforeach
                        </div>
                    </div>
                </td>

                <td>{!! \App\User::htmlStatuses()[$user->status] !!}</td>

                <td>{{ $user->created_at->format('d.m.Y H:i:s') }}</td>

                <td>
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Обрати дію') }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.profile.edit', $user->id) }}">
                                <i class="la la-edit"></i>
                                {{ __('Редагувати') }}
                            </a>

                            <a class="dropdown-item" href="#" role="button" data-toggle="modal" data-target="#modal-delete">
                                <i class="la la-trash text-danger"></i>
                                {{ __('Видалити') }}
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>