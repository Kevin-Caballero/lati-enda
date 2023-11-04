<?php
include('../../../src/database/db_connection.php');
include('../../../src/models/product.php');

$db = DbConnection::getInstance();
session_start();

function setCustomer($email, $address, $name = "guest", $pass = ""){
  $_SESSION["cart"]["customer"] = array(
    "name" => $name == "guest" ? $name.date('YmdHis') : $name,
    "address" => $address,
    "email" => $email,
    "password" => $pass
  );
}

function moveToSummary(){
  $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  header("Location: " . $base_url . "/ce1/src/pages/summary/summary.php");
}


if (isset($_POST['asGuest'])) {
  $guestEmail = $_POST['guestEmail'];
  $guestAddress = $_POST['guestAddress'];

  setCustomer($guestEmail, $guestAddress);
  moveToSummary();
}

if (isset($_POST['asUser'])) {
  $userName = $_POST['userName'];
  $userPassword = $_POST['userPassword'];
  $userEmail = $_POST['userEmail'];
  $userAddress = $_POST['userAddress'];

  setCustomer($userEmail, $userAddress, $userName, $userPassword);
  moveToSummary();
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
            <button type="submit" class="btn btn-success" name="asUser">Tramitar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>