<?php

namespace VFramework\Libraries;

abstract class Controller {

    /**
     * @param $view
     * @param array $data
     * @param array $errors
     */
    public function view($view, $data = [], $errors = []) {
        // Check for view file
        if(file_exists(ROOT_DIR . '/app/views/' . $view . '.php')) {
            require_once ROOT_DIR . '/app/views/' . $view . '.php';
        }
            die('View does not exist or was deleted');
    }
}
