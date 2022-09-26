<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../private_html/container.php";
if (!isset($container))
{
    $container = new container();
}


// Callback functions that require client to be authenticated.
if (isset($_SERVER['PHP_AUTH_USER']))
{

}

// Callback functions that require no authentication.