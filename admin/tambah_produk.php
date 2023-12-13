<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/tambah_produk.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>

    <div class="btn-back">
        <a href="index.php"><i class="fas fa-arrow-left"></i></a>
    </div>

    <h2>Tambah Produk</h2>

    <div class="container">
        <form action="">
            <div class="row">
                <div class="col-25">
                    <label for="nama"> Nama</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nama" name="nama" placeholder="Nama Produk...">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="harga">Harga</label>
                </div>
                <div class="col-75">
                    <input type="text" id="harga" name="harga" placeholder="Harga Produk...">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="formFileDisabled" class="form-label">Foto Produk</label>
                </div>
                <div class="mb-3">
                    <input class="form-control" type="file">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Deskripsi</label>
                </div>
                <div class="col-75">
                    <textarea id="deskripsi" name="Deskripsi" placeholder="Tulisan Deskripsi Produkmu..." style="height:200px; resize:none;"></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

</body>

</html>