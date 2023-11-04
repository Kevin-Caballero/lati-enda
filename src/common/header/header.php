<?php 
  function getCartCount(){
    $count = 0;
    if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0){
      foreach ($_SESSION["cart"] as $cartItemId => $cartItem) {
        if ($cartItemId !== "total" && $cartItemId !== "customer") {
          $count++;
        }
      }
      echo "(".$count.")";
    }
  }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
  <a class="navbar-brand" href="/ce1">
    <img src="../../../assets/logo1.png" alt="Logo" height="60"> <!-- Agrega la ruta de tu logo y ajusta la altura -->
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/ce1/src/pages/products/products.php?category=Libros">Libros</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/ce1/src/pages/products/products.php?category=Peliculas">Películas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/ce1/src/pages/products/products.php?category=Musica">Música</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/ce1/src/pages/products/products.php?category=Videojuegos">Videojuegos</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="/ce1/src/pages/cart/cart.php">
        <i class="fas fa-shopping-cart cart" style="font-size:2rem; color:white"></i>
        <?php getCartCount() ?>
      </a>
    </li>
  </ul>
  </div>
</nav>