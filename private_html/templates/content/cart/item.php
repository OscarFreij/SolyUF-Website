<li class="dropdown-text d-flex justify-content-between gap-3" data-productId="<?=$productId?>" data-productPrice="<?=$price?>">
    <div class="container">
        <div class="row mb-2">
            <span class="col-12"><?=$productName?></span>
        </div>
        <div class="btn-group mb-2" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-outline-danger" onclick="editCart(this, '-');">-</button>
            <input type="number" name="" id="" class="" value="<?=$count?>" min="0" style="text-align: center;" onchange="editCart(this, 'i');">
            <button type="button" class="btn btn-outline-success" onclick="editCart(this, '+');">+</button>
        </div>
        <div class="row">
            <span class="col-12"><?=$price * $count?> Kr</span>
        </div>
    </div>
</li>