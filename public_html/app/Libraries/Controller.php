<?php

namespace VFramework\Libraries;

abstract class Controller
{
    private const VIEWS_DIR = '/app/views/';

    /**
     * @param $view
     * @param array $data
     * @param array $errors
     */
    public function view(string $view, array $data = [], array $errors = []): void
    {
        // Check for view file
        if (file_exists(ROOT_DIR . self::VIEWS_DIR . $view . '.php')) {
            require_once ROOT_DIR . self::VIEWS_DIR . $view . '.php';
            exit();
        }
        die('View does not exist or was deleted');
    }
}
