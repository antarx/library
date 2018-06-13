<tr>
    <td>{{ $users->currentPage() * $loop->iteration }}</td>

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
    <td>
        <div class="dropdown dropdown-status">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {!! \App\User::htmlStatuses()[$user->status] !!}
            </a>

            <div class="dropdown-menu">
                @foreach(\App\User::htmlStatuses() as $id => $status)
                    <a class="dropdown-item" href="{{ route('admin.users.status', $user->id) }}" data-status="{{ $id }}">{!! $status !!}</a>
                @endforeach
            </div>
        </div>
    </td>
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