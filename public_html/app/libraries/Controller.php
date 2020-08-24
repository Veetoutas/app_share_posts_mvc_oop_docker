<?php
// Base Controller
// Load Models and Views

class Controller {

    // Load model
    public function model($model) {
        // Require model file
        require_once ROOT_DIR . '/app/models/' . $model . '.php';
        $object = new $model;
        return $object;
    }

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
