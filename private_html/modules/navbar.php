<nav class="navbar navbar-expand-lg bg-dark navbar-dark navbar-sticky">
  <div class="container-fluid">
    <span class="navbar-brand">
      <img src="static/images/soly.png" alt="" width="100" class="d-inline-block align-text-top">
    </span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100" id="navbarNav">
      <ul class="navbar-nav w-100 justify-content-evenly me-auto mb-2 mb-xl-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="?page=home">Hem</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=products">Produkter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=about">Om oss</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=contact">Kontakt</a>
        </li>
      </ul>
      <ul class="navbar-nav w-100 justify-content-end">
	  	<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="currentOpeningHours" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Varukorg
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="currentOpeningHours">
            <?php
              if (isset($_SESSION['cart']) && !is_null($_SESSION['cart']))
              {
                //display cart items
              }
              else
              {
                ?>
                <li class="dropdown-item dropdown-text d-flex justify-content-between gap-3">
                  <span class="text">Inga produkter i varukorgen!<br>Lägg till några från produkt sidan :)</span>
                </li>
                <?php
              }
            ?>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="container">
              <a class="btn btn-success w-100" href="?page=checkout">Gå till kassan</a> 
            </li>
          </ul>
        </li>
	    </ul>
    </div>
  </div>
</nav>