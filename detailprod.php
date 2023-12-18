<?php 
require 'functions.php';

$id = $_GET["id"];

$produk = query("SELECT * FROM tb_produk WHERE id = $id")[0];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/detailprod.css">
  <!-- Favicon -->
  <link rel="shortcut icon" href="https://i.pinimg.com/564x/cf/af/12/cfaf12db839a6edb74e5627ede4ad9ff.jpg" type="image/x-icon">
</head>

<body>
  <section>
    <div class="container flex">
      <div class="left">
        <div class="main_image">
          <img src="product_images/<?= $produk["gambar"]; ?>" class="slide">
        </div>
        <div class="option flex">
        </div>
      </div>  
      <div class="right">
        <h3><?= $produk["name"] ?></h3>
        <h4> <small>Rp</small><?= number_format($produk["price"]) ?> </h4>
        <p><?= $produk["deskripsi"] ?></p>
        <button><a href="allprod.php">See Product</a></button>
      </div>
    </div>
  </section>
  <script>
    function img(anything) {
      document.querySelector('.slide').src = anything;
    }

    function change(change) {
      const line = document.querySelector('.home');
      line.style.background = change;
    }
  </script>
</body>

</html>
