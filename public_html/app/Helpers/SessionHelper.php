<?php
session_start();

/**
 * @param string $name
 * @param string $message
 * @param string $class
 */
function flash(string $name = '', string $message = '', string $class = 'alert alert-success'): void
{
    if (!empty($name)) {

        if (!empty($message) && empty($_SESSION[$name])) {

            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name. '_class'])) {
                unset($_SESSION[$name. '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;

        }

        elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}

/**
 * @return bool
 */
function isLoggedIn(): bool
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }
        return false;
}
