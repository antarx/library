<div class="list-group">
    <a class="list-group-item {{ HtmlHelper::isActiveLink('*admin/dashboard') }}" href="{{ route('admin.dashboard') }}">
        <i class="la la-tv"></i>
        {{ __('Панель налаштування') }}
    </a>

    <a class="list-group-item {{ HtmlHelper::isActiveLink('*admin/pages*') }}" href="{{ route('admin.pages.index') }}">
        <i class="la la-copy"></i>
        {{ __('Сторінки') }}
    </a>

    <a class="list-group-item {{ (request()->is('*admin/categories*') || request()->is('*admin/products*')) ? null : 'collapsed' }}" href="#catalog" data-toggle="collapse" aria-expanded="{{ (request()->is('*admin/categories*') || request()->is('*admin/products*')) ? 'true' : 'false' }}">
        <i class="la la-shopping-cart"></i> @lang('Каталог')
    </a>

    <div id="catalog" class="list-group-collapse collapse {{ (request()->is('*admin/categories*') || request()->is('*admin/products*')) ? 'show' : null }}">
        <a class="list-group-item small {{ HtmlHelper::isActiveLink('*admin/categories*') }}" href="{{ route('admin.categories.index') }}">
            {{ __('Категорії') }}
        </a>

        <a class="list-group-item small {{ HtmlHelper::isActiveLink('*admin/products*') }}" href="{{ route('admin.products.index') }}">
            {{ __('Товари') }}
        </a>
    </div>

    <a class="list-group-item {{ HtmlHelper::isActiveLink('*admin/users*') }}" href="{{ route('admin.users.index') }}">
        <i class="la la-users"></i>
        {{ __('Користувачі') }}
    </a>

    <a class="list-group-item {{ HtmlHelper::isActiveLink('*admin/filemanager*') }}" href="{{ route('admin.filemanager.index') }}">
        <i class="la la-folder-open"></i>
        {{ __('Файловий менеджер') }}
    </a>

    <a class="list-group-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
        <i class="la la-power-off"></i>
        {{ __('Вийти') }}
    </a>
</div>