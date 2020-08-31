<?php

namespace VFramework\Libraries;

use VFramework\Models\Post;

class Controller {
    // Load view
    public function view($view, $data = [], $errors = []) {
        // Check for view file
        if(file_exists(ROOT_DIR . '/app/views/' . $view . '.php')) {
            require_once ROOT_DIR . '/app/views/' . $view . '.php';
        }
        else {
            die('View does not exist');
        }
    }
}
