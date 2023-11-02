<?php
include('../../../src/database/db_connection.php');
include('../../../src/models/product.php');

  $db = DConnection::getInstance();

  session_start();

  if (isset($_GET['category'])) {
    $selectedCategory = htmlspecialchars($_GET['category']);
    $products = getProductsByCategory($selectedCategory);
  }

  function getProductsByCategory($category) {
    global $db;
    $query = "select p.* from products p join categories c on c.id = p.category_id where c.name = '".$category."'";
    $res = $db->query($query);
    $products = [];
    while ($row = $res->fetch_assoc()) {
      $product = new Product($row['id'], $row['name'], $row['description'], $row['category_id'], $row['image_url'], $row['price'], $row['stock']);
      $products[] = $product;
    }
    return $products;
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
    <h3 class="mb-3">
      <?php echo $selectedCategory; ?>
    </h3>
    <div class="content-container mb-5">
      <div class="row d-flex flex-wrap">
        <?php if (isset($products)) foreach ($products as $product) {?>
          <div class="col-sm-4 mb-3">
            <a href="/ce1/src/pages/product_detail/product_detail.php?id=<?php echo $product->getid(); ?>">
              <div class="card" style="width: 15rem; height: 100%">
                <img class="card-img-top" height="200px" src="<?php echo $product->getimage_url()?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $product->getname()?></h5>
                </div>
              </div>
            </a>
          </div>
        <?php }?>
      </div>
    </div>
  </div>
</body>
</html>