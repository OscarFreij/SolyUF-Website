<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../private_html/container.php";
if (!isset($container))
{
    $container = new container();
}



if (isset($_SERVER['PHP_AUTH_USER'])) // Callback functions that require client to be authenticated.
{
    switch ($_POST['action']) {
        case 'addProduct':
            http_response_code(501);
            break;

        case 'editProduct':
            http_response_code(501);
            break;

        case 'removeProduct':
            http_response_code(501);
            break;

        case 'toggleOrderSent':
            http_response_code(501);
            break;
        
        case 'toggleOrderPaid':
            http_response_code(501);
            break;
        default:
            http_response_code(400);
            break;
    }
}
else // Callback functions that require no authentication.
{
    switch ($_POST['action']) {
        case 'contactForm':
            if (isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message']))
            {
                http_response_code(202);
                $container->functions()->sendFormEmail(array("email"=>$_POST['email'], "phone"=>$_POST['phone'], "msg"=>$_POST['message']));
            }
            else
            {
                http_response_code(400);
                return;
            }
            break;
        case 'addToCart':
            http_response_code(501);
            break;
        case 'removeFromCart':
            http_response_code(501);
            break;
        case 'placeOrder':
            http_response_code(501);
            break;
        default:
            http_response_code(400);
            break;
    }
}
