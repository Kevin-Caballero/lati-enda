<?php
include('../../../src/database/db_connection.php');
include('../../../src/models/product.php');

$db = DbConnection::getInstance();
$totalCarro = 0;

session_start();

function totalQuantity($idproduct){
  return isset($_SESSION["cart"][$idproduct]) ? $_SESSION["cart"][$idproduct]["quantity"] : 0 ;
}

function totalAmmount($quantity, $price){
  return $quantity * $price;
}

if(isset($_POST["checkout"])){
  if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $product) {
      $totalCarro += totalAmmount(totalQuantity($product["product"]->getid()), $product["product"]->getprice());
    }
  }
  
  $_SESSION["cart"]["total"] = $totalCarro;
  echo $totalCarro;
  $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  header("Location: " . $base_url . "/ce1/src/pages/checkout/checkout.php");
  exit();
}

if (isset($_POST['deleteProduct'])) {
  $id = $_POST["deleteProduct"];
  unset($_SESSION['cart'][$id]);
}

if (isset($_POST['increase'])) {
  $id = $_POST["increase"];
  $_SESSION['cart'][$id]["quantity"]++;
}

if(isset($_POST['decrease'])){
  $id = $_POST["decrease"];
  if($_SESSION['cart'][$id]["quantity"] > 1){
    $_SESSION['cart'][$id]["quantity"]--;
  }else{
    unset($_SESSION['cart'][$id]);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lati Enda</title>
  <link rel="icon" href="../../../assets/logo1.png" type="image/png">
  <link rel="stylesheet" type="text/css" href="cart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <?php include('../../../src/common/header/header.php') ?>

  <div class="container categories-wrapper">
    <div class="card">
      <div class="card-header bg-dark text-white text-center">
          <h1>CESTA</h1>
      </div>
      <div class="card-body">
          <table class="table">
              <thead class="bg-secondary text-white">
                  <th class="text-center">Nombre</th>
                  <th class="text-center">PVP</th>
                  <th class="text-center">Cantidad</th>
                  <th class="text-center">Importe</th>
                  <th class="text-center"></th>
              </thead>
              <tbody>
              <?php if (isset($_SESSION["cart"])) foreach ($_SESSION["cart"] as $product) {?>
                  <tr>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                      <td><?php echo $product["product"]->getname() ?></td>
                      <td class="text-center"><?php echo $product["product"]->getprice()."€" ?></td>
                      <td class="text-center">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <button id="updateButton" name="decrease" value="<?php echo $product["product"]->getid(); ?>" type="submit" class="btn btn-outline-secondary">
                              <i class="fas fa-minus"></i>
                            </button>
                          </div>
                          <input type="text" style="width: 1rem" class="form-control text-center" value="<?php echo totalQuantity($product["product"]->getid()) ?>" readonly>
                          <div class="input-group-append">
                            <button id="updateButton" name="increase" value="<?php echo $product["product"]->getid(); ?>" type="submit" class="btn btn-outline-secondary">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                      </td>
                      <td class="text-center"><?php echo totalAmmount(totalQuantity($product["product"]->getid()), $product["product"]->getprice())."€"?></td>
                      <td class="text-center">
                        <button id="deleteButton" name="deleteProduct" value="<?php echo $product["product"]->getid(); ?>" type="submit" class="btn btn-outline-danger">
                          <i class="fas fa-trash text-danger"></i>
                        </button>
                      </td>
                      <?php $totalCarro += totalAmmount(totalQuantity($product["product"]->getid()), $product["product"]->getprice()) ?>
                    </form>
                  </tr>
                  <?php }?>
              </tbody>
          </table>
      </div>
      <div class="card-footer bg-dark text-white d-flex justify-content-between pr-5 pl-5">
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <button type="submit" name="checkout" class="btn btn-success d-flex align-items-center">Tramitar pedido</button>
        </form>
          <h2>Total: <?php if (isset($totalCarro)) {
                    echo $totalCarro."€";
                } else{
                    echo "0";
                }?>
          </h2>
      </div>
    </div>
  </div>
</body>
</html>