<?php
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
<div class="accordion-item">
    <h2 class="accordion-header" id="order<?= $order['id'] ?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order<?= $order['id'] ?>collapse" aria-expanded="false" aria-controls="order<?= $order['id'] ?>collapse">
            Order #<?= $order['id'] ?>
        </button>
    </h2>
    <div id="order<?= $order['id'] ?>collapse" class="accordion-collapse collapse" aria-labelledby="order<?= $order['id'] ?>" data-bs-parent="#orderAccordion">
        <div class="accordion-body">
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
                        require "../private_html/templates/content/admin/item.php";
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3 text text-center">
                <span>Totalt pris: <?= $order['totalPrice'] ?> Kr</span>
            </div>
            <div class="row mb-3 text text-center">
                <div class="container">
                <div class="row justify-content-around">
                    <?php
                    if (!$order['paid'])
                    {
                        ?>
                        <button class="col-4 btn btn-warning" onclick="confirmPayment(<?=$order['id']?>)">
                            Markera som betald
                        </button>
                        <?php
                    }
                    if (!$order['sent'])
                    {
                        ?>
                        <button class="col-4 btn btn-info" onclick="confirmSent(<?=$order['id']?>)">
                            Markera som skickad
                        </button>
                        <?php
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>