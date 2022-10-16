<?php
$order = $container->functions()->GetOrder($_GET['orderId']);
$swishCredentials = $container->credentials()->getSwishCredentials();
if ($order['paid']) {
    $paid = '<span class="text-success">Ja</span>';
} else {
    $paid = '<span class="text-danger">Nej</span>';
}

if ($order['sent']) {
    $sent = '<span class="text-success">Ja</span>';
} else {
    $sent = '<span class="text-danger">Nej</span>';
}
?>
<div class="container py-5">
    <div class="row my-3">
        <p class="fs-1 text-center text">
            Beställning: #<?= $_GET['orderId'] ?>
        </p>
    </div>
    <div class="row mb-3 text text-center">
        <span>Betalad: <?= $paid ?> | Skickad: <?= $sent ?></span>
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
            </div>
            <?php
            $orderData = json_decode($order['orderData']);
            for ($i = 0; $i < count($orderData); $i++) {
                $data = $container->functions()->GetItem($orderData[$i]->id);
                $productId = $data['id'];
                $productName = $data['name'];
                $count = $orderData[$i]->count;
                require "../private_html/templates/content/order/item.php";
            }
            ?>
        </div>
    </div>
    <div class="row mb-3 text text-center">
        <span>Totalt pris: <?= $order['totalPrice'] ?> Kr</span>
    </div>
    <?php
    if (!$order['paid']) {
    ?>
        <div class="row mb-3 text text-center">
            <span>Betala genom att skanna nedan QR kod med swish.<br>Betalningshantering och verifiering är <b>manuel</b> och dycker därför inte upp direkt när du betalar.</span>
            <span>Kontrolera att mottagare står som "<b><?= $swishCredentials['swishReceiverName'] ?></b>" när du genomför betallningen!</span>
            <img class="swish-qr" src="<?= $container->functions()->GenerateQRCode($swishCredentials['swishPhonenumber'], $order['totalPrice'], $_GET['orderId']); ?>">
        </div>
    <?php
    }
    ?>
</div>