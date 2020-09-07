<?php

namespace VFramework\Helpers;

class UrlHelper
{
    /**
     * @param $page
     */
    public static function redirect(string $page): void
    {
        header ('location:'. URL_ROOT. '/'. $page);
    }
}
