<?php
require '../functions.php';

if (isset($_POST['submit'])) {

    function rupiahToNumber($rupiah)
    {
        return preg_replace('/[^0-9]/', '', $rupiah); // Remove non-numeric characters
    }

    $_POST['harga_produk'] = rupiahToNumber($_POST['harga_produk']);    

    //cek apakah data berhasil ditambahkan atau tidak 
    if (tambahProduk($_POST) > 0) {
        echo
        "<script>
          alert('Data berhasil ditambahkan!');
          document.location.href = 'tambah_produk.php';
      </script>";
    } else {
        echo
        "<script>
          alert('Data gagal ditambahkan!');
      </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/tambah_produk.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Tambah Produk</title>
</head>

<body>

    <div class="btn-back">
        <a href="index.php"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h2>Tambah Produk</h2>

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-25">
                    <label for="nama"> Nama</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nama" name="nama_produk" placeholder="Nama Produk...">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="harga">Harga</label>
                </div>
                <div class="col-75">
                    <input type="text" id="harga" name="harga_produk" placeholder="Harga Produk..." onkeyup="formatRupiah()">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Deskripsi</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="deksripsi_produk" placeholder="Tulisan Deskripsi Produkmu..." style="height:200px; resize:none;"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="formFileDisabled" class="form-label">Foto Produk</label>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="file" name="gambar_produk">
                </div>
            </div>
            <div class="row">
                <input type="submit" name="submit">
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>

</body>

</html>