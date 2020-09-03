<?php

namespace VFramework\Helpers;

class UrlHelper
{
    /**
     * @param $page
     */
    static function redirect($page)
    {
        header ('location:'. URL_ROOT. '/'. $page);
    }
}
