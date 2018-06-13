<ul class="nav nav-users">
    <li class="nav-item">
        <a class="nav-link {{ HtmlHelper::isActiveLink('*admin/users/*/profile*') }}" href="{{ route('admin.profile.edit', $user->id) }}">
            {{ __('Профіль') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ HtmlHelper::isActiveLink('*admin/users/*/ips*') }}" href="{{ route('admin.ips.edit', $user->id) }}">
            {{ __('IP-адреси') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ HtmlHelper::isActiveLink('*admin/users/*/orders*') }}" href="{{ route('admin.orders.index', $user->id) }}">
            {{ __('Замовлення') }}
        </a>
    </li>
</ul>

<hr class="mb-5">