<?php 

/**
 * 
 * Redirect to another url on the same site
 * 
 * @param string $path The path to redirect to
 * 
 * @return void
 * 
 */

function redirect($path) {
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }

    header("Location: $protocol://". $_SERVER['HTTP_HOST'] . $path); //redirection
    exit; //exiting script after a redirect is a good practice
}