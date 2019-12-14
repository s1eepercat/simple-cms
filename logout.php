<?php 

require 'includes/url.php';

session_start(); //needs to be here so that script knows we are still working with a current session

$_SESSION = array(); //empty

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); 

redirect('/udemy');