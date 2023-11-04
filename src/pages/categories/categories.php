<?php
include('../../../src/database/db_connection.php');
include('../../../src/models/category.php');

$db = DbConnection::getInstance();
$categories = getCategories();
session_start();

function getCategories() {
  global $db;
  $res = $db->query("select * from categories");
  $categories = [];
  while ($row = $res->fetch_assoc()) {
    $category = new Category($row['id'], $row['name'], $row['image_url']);
    $categories[] = $category;
  }
  return $categories;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lati Enda</title>
  <link rel="icon" href="../../../assets/logo1.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="categories.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <?php include('../../../src/common/header/header.php') ?>

  <div class="container categories-wrapper">
    <div class="row">
      <?php if (isset($categories)) foreach ($categories as $category) {?>
        <div class="col-sm mb-3">
            <div class="card" style="width: 15rem;">
              <img class="card-img-top" height="160px" src="<?php echo $category->getimage_url()?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo $category->getname()?></h5>
                <a href="/ce1/src/pages/products/products.php?category=<?php echo urlencode($category->getname()); ?>" class="btn btn-dark">Ver</a>
              </div>
            </div>
          </div>
        <?php }?>
    </div>
  </div>
</body>
</html>