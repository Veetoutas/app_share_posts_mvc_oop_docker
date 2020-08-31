<?php

namespace VFramework\Helpers;

class UrlHelper
{
    static function redirect($page)
    {
        header ('location:'. URL_ROOT. '/'. $page);
    }
}
