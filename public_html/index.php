<?php
    ob_start();
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    
    //require_once "../private_html/container.php";
    //$container = new container();
?>

<!doctype html>
<html lang="en">

<?php
require_once "../private_html/modules/head.php";
?>

<body class="d-flex flex-column min-vh-100">
    <?php
    include_once "../private_html/modules/header.php";
    include_once "../private_html/modules/navbar.php";
    if (http_response_code() == 200 && !isset($_GET['epage']))
    {
        if (isset($_GET['page']))
        {
            if (file_exists("../private_html/pages/".$_GET['page'].".php"))
            {
                require_once "../private_html/pages/".$_GET['page'].".php";
            }
            else
            {
                require_once "../private_html/pages/error/404.php";
            }
        }
        else
        {
            require_once "../private_html/pages/home.php";
        }    
    }
    else if (!isset($_GET['epage']))
    {
        require_once "../private_html/pages/error/".http_response_code().".php";
    }
    else
    {
        require_once "../private_html/pages/error/".$_GET['epage'].".php";
    }
    
    include_once "../private_html/modules/footer.php";
    require_once "../private_html/modules/postload.php";
    ?>
</body>
</html>