<?php
require '../functions.php';


$dataProduk = query("SELECT * FROM tb_produk");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="../css/admin.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#" class="sidebar">
                        <i class="fas fa-menorah"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                <li><a href="../logout.php" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log out</span>
                    </a></li>
            </ul>
        </nav>


        <section class="main">
            <div class="main-top">
                <h1>Halaman Admin - Manajemen Produk</h1>
            </div>
            <div class="users">
            </div>
            <section class="attendance">
                <div class="attendance-list">
                    <h1>List Produk</h1>
                    <a href="tambah_produk.php" class="button-3">Tambah</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php if ($dataProduk) : ?>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($dataProduk as $produk) :  ?>
                                <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $produk["name"] ?></td>
                                        <td>Rp.<?= number_format($produk["price"])  ?></td>
                                        <td><?= $produk["deskripsi"] ?></td>
                                        <td><img src="../product_images/<?= $produk["gambar"] ?>" alt=""></td>
                                        <td class="aksi">
                                            <a href="edit_produk.php?id=<?= $produk['id'] ?>"><button class="btn-edit"><i class="fas fa-pen"></i></button></a>
                                            <a href="hapus_produk.php?id=<?= $produk['id']; ?>"><button class="btn-hapus"><i class="fas fa-trash"></i></button></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                            </tbody>
                        <?php else : ?>
                            <h1 class="no-found">Belum ada data produk!</h1>
                        <?php endif; ?>
                    </table>
                </div>
            </section>
        </section>
    </div>

</body>

</html>