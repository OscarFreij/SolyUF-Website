<div class="container py-5">
    <div class="row my-3">
        <p class="fs-1 text-center text">
            Kassa
        </p>
    </div>
    <div class="row mb-3">
        <div id="product-list" class="container fs-5">
            <div class="product-list-header container row text border-bottom border-dark border-2 text-center text-sm-start mx-0">
                <span class="col-12 col-sm-8 text fw-bold">
                    Produkt namn
                </span>
                <span class="col-12 col-sm-2 text fw-bold">
                    Antal
                </span>
                <span class="col-12 col-sm-2 text fw-bold">
                    Pris
                </span>
            </div>
            <?php
            $totalPrice = 0;
            if (isset($_SESSION['cart']) && !is_null($_SESSION['cart'])) {

                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    $data = $container->functions()->GetItem($_SESSION['cart'][$i]['id']);
                    $productId = $data['id'];
                    $productName = $data['name'];
                    $price = $data['price'];
                    $count = $_SESSION['cart'][$i]['count'];
                    require "../private_html/templates/content/checkout/item.php";
                    $totalPrice += ((int)$price * (int)$count);
                }
            }
            $_SESSION['totalPrice'] = $totalPrice;
            ?>
        </div>
    </div>
    <div class="row mb-3 text text-center">
        <span>Totalt pris: <?= $totalPrice ?> Kr (+39Kr frakt)</span>
    </div>
    <div class="row mb-3 w-100 mx-0">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmOrderModal">
            Fortsätt med beställningen!
        </button>
    </div>
</div>

<?php
require "../private_html/templates/modal/checkout/confirmOrder.php";
?>