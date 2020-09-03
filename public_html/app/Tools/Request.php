<?php

namespace VFramework\Tools;

class Request
{
    /**
     * @var string
     */
    private $method = '';

    /**
     * @param $method
     * @return bool
     */
    public function requested($method)
    {
        // POST
        if ($_SERVER['REQUEST_METHOD'] == $method) {
            return true;
        }
        return false;
    }
}
