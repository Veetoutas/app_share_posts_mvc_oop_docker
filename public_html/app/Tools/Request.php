<?php

namespace VFramework\Tools;

class Request
{
    private const METHOD = 'GET';

    /**
     * @param string $method
     * @return bool
     */
    public function requested(string $method): bool
    {
        // POST
        if ($_SERVER['REQUEST_METHOD'] == self::METHOD) {
            return false;
        }
        return true;
    }
}
