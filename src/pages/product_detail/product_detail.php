<?php
  include('../../../src/database/db_connection.php');
  include('../../../src/models/product.php');

  session_start();

  $db = DbConnection::getInstance();

  if (isset($_GET['id'])) {
    $productId = htmlspecialchars($_GET['id']);
    $product = getProductById($productId);
  }

  function getProductById($id) {
    global $db;
    $query = "select * from products where id = ".$id;
    $res = $db->query($query);
    $product = null;
    while ($row = $res->fetch_assoc()) {
      $product = new Product($row['id'], $row['name'], $row['description'], $row['category_id'], $row['image_url'], $row['price'], $row['stock']);
    }
    return $product;
  }

  function getStockClass() {
    global $product;
    if ($product->getstock() > 25) {
      return "text-success";
    } else if ($product->getstock() > 5 && $product->getstock() <= 25) {
      return "text-warning";
    } else {
      return "text-danger";
    }
  }


  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  if (isset($_POST['addToCart'])) {
    $id = $_POST["addToCart"];
    $quantity = $_POST["quantity"];

    if ($quantity == 0) {
      if(isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
      }else{
        $atLeastOne = true;
      }
    } else {
      $_SESSION['cart'][$id] = array(
        'product' => $product,
        'quantity' => $quantity
      );
      $added = true;
    }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="icon" href="../../../assets/logo1.png" type="image/png">
  <link rel="stylesheet" type="text/css" href="product_detail.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <?php include('../../../src/common/header/header.php') ?>
  <div class="container" style="display: flex; justify-content: center; align-items: center; height: 80vh">
    <div class="product-wrapper">
      <img height="350px" class="mr-5 product-image" src="<?php echo $product->getimage_url()?>" alt="">
      <div class="product-data">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <h3 class="mb-5"><?php echo $product->getname()?></h3>
          <p><?php echo $product->getdescripcion()?></p>
          <span style="width: fit-content; padding: .5rem" class="mb-3 badge badge-light <?php echo getStockClass()?>" >Nos quedan <?php echo $product->getstock()?> Uds</span>
          <h4 class="mb-3"><?php echo $product->getprice()?>€</h4>
          <div class="input-group mb-3">
            <input type="number" class="form-control" min="0" name="quantity" placeholder="Cantidad..." value="<?php echo isset($_SESSION['cart'][$product->getid()]) ? $_SESSION['cart'][$product->getid()]["quantity"] : 0?>">
            <div class="input-group-append">
              <button class="btn btn-success" type="submit" value="<?php echo $product->getid()?>" name="addToCart">
                Añadir al carrito
                <i class="fas fa-shopping-cart" style="font-size:1rem; color:white"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php if (isset($added) && $added === true) {?>
    <div style="position: absolute; bottom: 0; right: 0" class="alert alert-success" role="alert">
      <?php echo $quantity?> producto<?php if($quantity > 1) echo 's'?> añadido<?php if($quantity > 1) echo 's'?> al carrito: <strong><?php echo $product->getname()?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }?>

  <?php if (isset($atLeastOne) && $atLeastOne === true) {?>
    <div style="position: absolute; bottom: 0; right: 0" class="alert alert-danger" role="alert">
      Debes añadir al menos un producto al carrito: <strong><?php echo $product->getname()?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php }?>
</body>
</html>