<?php

namespace App\Helpers;


class HtmlHelper extends Helper
{
    public function isActiveLink($url, $active = 'active', $default = '')
    {
        return request()->is($url)
            ? $active
            : $default;
    }
}