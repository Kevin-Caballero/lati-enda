<?php
include('../../../src/database/db_connection.php');
include('../../../src/models/product.php');

$db = DbConnection::getInstance();
session_start();

function persistOrder($email, $address, $name = "guest", $pass = "guestpass") {
  global $db;
  $customer = array(
    "name" => $name == "guest" ? "guest".date('YmdHis') : $name, 
    "address" => $address, 
    "email" => $email, 
    "password" => $pass
  );
  $customerInsertedId = $db->insert("customers", $customer);
  
  $order = array(
    "customer_id" => $customerInsertedId,
    "date" => date('Y-m-d'),
    "total_amount" => isset($_SESSION["cart"]["total"]) ? $_SESSION["cart"]["total"] : 0
  );
  $orderInsertedId = $db->insert("orders", $order);

  if(is_array($_SESSION["cart"])){
    foreach ($_SESSION["cart"] as $productId => $cartItem) {
      $productData = $_SESSION["cart"][$productId]["product"];
      //$productData = $cartItem["product"];
  
      if ($productData instanceof Product) {
          $product_id = $productData->getid();
          $quantity = $cartItem["quantity"];
          $price = $productData->getprice();
  
          $detail = array(
              "order_id" => $orderInsertedId,
              "product_id" => $product_id,
              "quantity" => $quantity,
              "price" => $price
          );
  
          $db->insert("order_details", $detail);
      }
    }
  }
}


if (isset($_POST['asGuest'])) {
  $guestEmail = $_POST['guestEmail'];
  $guestAddress = $_POST['guestAddress'];

  print_r([$guestAddress, $guestEmail]) ;
  persistOrder($guestEmail, $guestAddress);
}

if (isset($_POST['asUser'])) {
  $userName = $_POST['userName'];
  $userPassword = $_POST['userPassword'];
  $userEmail = $_POST['userEmail'];
  $userAddress = $_POST['userAddress'];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lati Enda</title>
  <link rel="icon" href="../../../assets/logo1.png" type="image/png">
  <link rel="stylesheet" type="text/css" href="products.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
  <?php include('../../../src/common/header/header.php') ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-5 guest card p-0" style="height: fit-content">
        <div class="card-header bg-dark text-white">
          Como invitado
        </div>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="guestEmail" class="form-control" placeholder="johndoe@gmail.com">
            </div>
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" name="guestAddress" class="form-control" placeholder="C/falsa 123">
            </div>
          </div>
          <div class="card-footer bg-dark">
            <button type="submit" name="asGuest" class="btn btn-success">Tramitar</button>
          </div>
        </form>
      </div>

      <div class="col-sm-2"></div>

      <div class="col-sm-5 user card p-0">
        <div class="card-header bg-dark text-white">
          Como usuario
        </div>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputPassword1">Nombre</label>
              <input type="text" name="userName" class="form-control" placeholder="John Doe">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" name="userPassword" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="userEmail" class="form-control" placeholder="johndoe@gmail.com">
            </div>
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" name="userAddress" class="form-control" placeholder="C/falsa 123">
            </div>
          </div>
          <div class="card-footer bg-dark">
            <button type="submit" class="btn btn-success">Tramitar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>