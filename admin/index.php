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
                <li ><a href="#" class="sidebar">
                        <i class="fas fa-menorah"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                <li><a href="#" class="logout">
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
                    <div class="button-3">Tambah</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01</td>
                                <td>Bunga Cinta</td>
                                <td>Rp.200,000</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni, corrupti dolores doloribus, molestias id amet architecto adipisci totam alias, aliquid officiis veritatis quod? Quod sunt libero, iure labore amet doloribus eligendi adipisci officia enim veniam et, iusto perspiciatis quia quos dolorem temporibus, nobis velit reiciendis magnam tempora quibusdam exercitationem!</td>
                                <td><img src="./images/product-1-3/product_1.jpg" alt=""></td>
                                <td class="aksi">
                                    <a href=""><button class="btn-edit"><i class="fas fa-pen"></i></button></a>
                                    <a href=""><button class="btn-hapus"><i class="fas fa-trash"></i></button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </div>

</body>

</html>