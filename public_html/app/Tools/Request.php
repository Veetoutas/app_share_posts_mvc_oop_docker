<?php

namespace VFramework\Tools;

class Request
{
    private $method = '';

    public function requested($method)
    {
        // POST
        if ($_SERVER['REQUEST_METHOD'] == $method) {
            return true;
        }
        return false;
    }
}
