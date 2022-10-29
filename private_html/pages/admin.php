
<?php
    $orders = $container->functions()->GetOrders();
?>

<div class="container py-5">
    <div class="row my-3">
        <p class="fs-1 text-center text">
            Admin
        </p>
    </div>
    <div class="row my-3">
        <div class="accordion" id="orderAccordion">
            <?php
                foreach ($orders as $key => $order) {
                    include "../private_html/templates/content/admin/acordionItem.php";
                }
            ?>
        </div>
    </div>
    <!--
    <div class="row my-3">
        <div class="container">
            <div class="row justify-content-around">
            <button class="btn btn-success col-5" data-bs-toggle="modal" data-bs-target="#createProductModal">
                Lägg till produkt
            </button>
            <button class="btn btn-success col-5" data-bs-toggle="modal" data-bs-target="#createImageModal">
                Lägg till bild
            </button>
            </div>
        </div>
    </div>
    -->
</div>

<?php
    require "../private_html/templates/modal/admin/createProduct.php";
    require "../private_html/templates/modal/admin/createImage.php";
?>
