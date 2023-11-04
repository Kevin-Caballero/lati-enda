<?php
include('../../../src/database/db_connection.php');
include('../../../src/models/product.php');

$db = DbConnection::getInstance();
session_start();

function persistOrder() {
  global $db;
  $customer = $_SESSION["cart"]["customer"];
  $customerInsertedId = $db->insert("customers", $customer);

  $order = array(
    "customer_id" => $customerInsertedId,
    "date" => date('Y-m-d'),
    "total_amount" => isset($_SESSION["cart"]["total"]) ? $_SESSION["cart"]["total"] : 0
  );
  $orderInsertedId = $db->insert("orders", $order);

  if(is_array($_SESSION["cart"])){
    foreach ($_SESSION["cart"] as $productId => $cartItem) {
      if (isset($cartItem["product"]) && $cartItem["product"] instanceof Product) {
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
}

function moveToHome(){
  $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  header("Location: " . $base_url . "/ce1");
}

if(isset($_POST["finish"])){
  persistOrder();
  $_SESSION["cart"] = array();
  moveToHome();
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
    <div class="card" style="max-height: 80%">
      <div class="card-header bg-dark text-white"><h3>Resumen de compra</h3></div>
      <div class="card-body d-flex flex-column">
      <div class="customer-info">
        <?php
        if (isset($_SESSION["cart"]["customer"])) {
          $customerInfo = $_SESSION["cart"]["customer"];
          echo '<p><strong>Nombre:</strong> ' . $customerInfo["name"] . '</p>';
          echo '<p><strong>Email:</strong> ' . $customerInfo["email"] . '</p>';
          echo '<p><strong>Dirección:</strong> ' . $customerInfo["address"] . '</p>';
        }
        ?>
      </div>
      <div class="order-info">
        <table class="table table-bordered table-striped">
          <thead class="thead-secondary">
            <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio Unitario</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
          <?php
            if (isset($_SESSION["cart"]) && is_array($_SESSION["cart"])) {
              foreach ($_SESSION["cart"] as $productId => $cartItem) {
                if (isset($cartItem["product"]) && $cartItem["product"] instanceof Product) {
                  $productData = $cartItem["product"];
                  $productName = $productData->getname();
                  $quantity = $cartItem["quantity"];
                  $price = $productData->getprice();
                  $totalPrice = $quantity * $price;

                  echo '<tr>';
                  echo '<td>'.$productName.'</td>';
                  echo '<td>'.$quantity.'</td>';
                  echo '<td>'.number_format($price, 2)."€".'</td>';
                  echo '<td>'.number_format($totalPrice, 2)."€".'</td>';
                  echo '</tr>';
                }
              }
            }
          ?>
          </tbody>
        </table>
        </div>
      </div>
      <div class="card-footer bg-dark text-white d-flex justify-content-between pr-5 pl-5">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <button class="btn btn-success d-flex align-items-center" type="submit" name="finish">Finalizar compra</button>
        </form>
        <h2>Total: <?php if (isset($_SESSION["cart"]["total"])) {
                    echo $_SESSION["cart"]["total"]."€";
                } else{
                    echo "0";
                }?>
          </h2>
      </div>
    </div>
  </div>
</body>
</html>