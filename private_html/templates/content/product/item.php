<div class="col">
    <div class="card h-100">
        <?php
        if (is_null($item['imageCSV']) || $item['imageCSV'] == "") {
        ?>
            <svg class="bd-placeholder-img card-img-top card-image" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em" dominant-baseline="middle" text-anchor="middle">
                    Placeholder Image
                </text>
            </svg>
        <?php
        } else if (!strpos($item['imageCSV'], ',')) {
        ?>
            <img class="card-img-top card-image" src="<?= urldecode(base64_decode($container->functions()->GetImage($item['imageCSV'])['data'])) ?>" alt="pictue of product">
        <?php
        } else {
            $imageIds = explode(',', $item['imageCSV']);
        ?>
            <div id="product<?= $item['id'] ?>Carousel" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#product<?= $item['id'] ?>Carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <?php
                        for ($j = 1; $j < count($imageIds); $j++)
                        {
                            $k = $j;
                            ?>
                            <button type="button" data-bs-target="#product<?= $item['id'] ?>Carousel" data-bs-slide-to="<?=$j?>" aria-label="Slide <?=$j?>"></button>
                            <?php
                        }
                    ?>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= urldecode(base64_decode($container->functions()->GetImage($imageIds[0])['data'])) ?>" class="d-block w-100 card-img-top card-image bg-dark" alt="...">
                    </div>
                    <?php
                    for ($j = 1; $j < count($imageIds); $j++)
                    {
                        $image = urldecode(base64_decode($container->functions()->GetImage($imageIds[$j])['data']));
                        ?>
                        <div class="carousel-item">
                            <img src="<?= $image ?>" class="d-block w-100 card-img-top card-image bg-dark" alt="...">
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#product<?= $item['id'] ?>Carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#product<?= $item['id'] ?>Carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php
        }
        ?>
        <div class="card-body">
            <h5 class="card-title"><?= $item['name'] ?></h5>
            <p class="card-text"><?= $item['description'] ?></p>
        </div>
        <div class="card-body">
            <p><?= $item['price'] ?> Kr/st</p>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-success w-100" onclick="addNewToCart(<?= $item['id'] ?>);">Lägg produkt i kundvagn</button>
        </div>
    </div>
</div>