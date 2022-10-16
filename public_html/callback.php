<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../private_html/container.php";
if (!isset($container)) {
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
// Callback functions that require no authentication.
switch ($_POST['action']) {
    case 'contactForm':
        if (isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message'])) {
            http_response_code(202);
            $container->functions()->sendFormEmail(array("email" => $_POST['email'], "phone" => $_POST['phone'], "msg" => $_POST['message']));
        } else {
            http_response_code(400);
            return;
        }
        break;
    case 'editCart':
        if (isset($_POST['itemId']) && isset($_POST['itemCount'])) {
            http_response_code(202);
            if (isset($_SESSION['cart'])) {
                $itemIsNew = true;
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i]['id'] == $_POST['itemId']) {
                        $_SESSION['cart'][$i]['count'] = $_POST['itemCount'];
                        $itemIsNew = false;
                        break;
                    } else {
                        continue;
                    }
                }

                if ($itemIsNew) {
                    array_push($_SESSION['cart'], array("id" => $_POST['itemId'], "count" => $_POST['itemCount']));
                }



                $tempCart = array();

                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i]['count'] > 0) {
                        array_push($tempCart, $_SESSION['cart'][$i]);
                    }
                }

                $_SESSION['cart'] = $tempCart;
            } else {
                $_SESSION['cart'] = array();
                array_push($_SESSION['cart'], array("id" => $_POST['itemId'], "count" => $_POST['itemCount']));
            }
        } else {
            http_response_code(400);
            return;
        }
        break;
    case 'placeOrder':
        http_response_code(202);
        if (isset($_POST['orderEmail']) && isset($_POST['orderPhone']) && isset($_POST['orderAddress']) && isset($_POST['orderPostalcode']) && isset($_POST['orderCity']) && isset($_SESSION['cart']) && isset($_SESSION['totalPrice'])) {
            $orderId = $container->functions()->CreateOrder($_POST['orderEmail'], $_POST['orderPhone'], $_POST['orderAddress'], $_POST['orderPostalcode'], $_POST['orderCity'], json_encode($_SESSION['cart']), $_SESSION['totalPrice']);
            echo ($orderId);
        } else {
            http_response_code(400);
            return;
        }
        break;
    default:
        http_response_code(400);
        break;
}
