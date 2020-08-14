<?php
    session_start();

    // Flash message helper
    function flash($name = '', $message = '', $class = 'alert alert-success') {
        if(!empty($name)) {
            if(!empty($message) && empty($_SESSION[$name])) {
                if(empty($_SESSION['name'])) {
                    unset($_SESSION['name']);
                }
                $_SESSION[$name] = $name;
                $_SESSION[$name. '_class'] = $class;
            }
        }
    }

//    $_SESSION['register_success'];