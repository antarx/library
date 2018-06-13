<?php

namespace App\Helpers\Facades;


use Illuminate\Support\Facades\Facade;

class HtmlHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'htmlhelper';
    }
}