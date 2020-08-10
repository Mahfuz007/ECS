<?php
//start session
session_start();

//location redirect function
function redirect($pages)
{
    header('Location:' . URLROOT . $pages);
}

//Set Flash Message
function setFlash($name, $message)
{
    if (!empty($name) && !empty($message)) {
        $_SESSION[$name] = $message;
    }
}

//Flash message Function
function flash($name, $class = "alert alert-success")
{
    if (!empty($name) && isset($_SESSION[$name])) {
        echo '<div class="' . $class . '" style="margin: 1em;text-align: center" role="alert">' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]);
    }
}
