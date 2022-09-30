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

if (isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message']))
{
    $container->functions()->sendFormEmail(array("email"=>$_POST['email'], "phone"=>$_POST['phone'], "msg"=>$_POST['message']));
}
