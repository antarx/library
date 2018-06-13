<div class="list-group">
    <a class="list-group-item {{ HtmlHelper::isActiveLink('*profile') }}" href="{{ route('profile.user.edit') }}">
        <i class="la la-user"></i>
        {{ __('Мій профіль') }}
    </a>

    <a class="list-group-item {{ HtmlHelper::isActiveLink('*profile/orders*') }}" href="{{ route('profile.orders.index') }}">
        <i class="la la-shopping-cart"></i>
        {{ __('Мої замовлення') }}
    </a>

    <a class="list-group-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
        <i class="la la-power-off"></i>
        {{ __('Вийти') }}
    </a>
</div>
