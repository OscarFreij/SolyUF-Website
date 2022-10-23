<div class="container py-5">
    <div class="row my-3">
        <p class="fs-1 text-center text">
            Våra produkter
        </p>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
            $items = $container->functions()->GetItems();
            for ($i=0; $i < count($items); $i++) { 
                $item = $items[$i];
                if ($item['visible'])
                {
                    require "../private_html/templates/content/product/item.php";
                }
            }
        ?>
    </div>
</div>