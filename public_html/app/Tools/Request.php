<?php

namespace VFramework\Tools;

class Request
{
    /**
     * @var string
     */
    private $method = '';

    /**
     * @param string $method
     * @return bool
     */
    public function requested(string $method): bool
    {
        // POST
        if ($_SERVER['REQUEST_METHOD'] == $method) {
            return true;
        }
        return false;
    }
}
