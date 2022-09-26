<div class="postload">
    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script src="static/js/jquery-3.6.1.min.js"></script>
    <script src="static/js/main.js"></script>
    <script src="static/js/navbar.js"></script>
    <?php
    if (isset($_GET['page']))
    {
        if (file_exists("static/js/".$_GET['page'].".js"))
        {
            ?>
                <script src="static/js/<?=$_GET['page']?>.js"></script>
            <?php
        }
    }
    ?>
</div>