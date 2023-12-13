<?php
require 'koneksi.php';

function query($query)
{
    global $koneksi;

    $rows = [];
    $result = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }


    return $rows;
}


function tambahUser($data)
{
    global $koneksi;

    $username = htmlspecialchars($data["username"]);
    $email =  htmlspecialchars($data["email"]);
    $password =  htmlspecialchars($data["password"]);

    $query = "INSERT INTO tb_user VALUES ('', '$username', '$email', '$password', 'user')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tambahProduk($data)
{
    global $koneksi;

    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);
    $deskripsi_produk = htmlspecialchars($data["deksripsi_produk"]);


    $gambar = upload();
    if (!$gambar) {
        return false;
    }


    $query = "INSERT INTO tb_produk VALUES ('', '$nama_produk', '$harga_produk', '$deskripsi_produk', '$gambar')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function upload()
{
    $namaFile = $_FILES['gambar_produk']['name'];
    $ukuranFile = $_FILES['gambar_produk']['size'];
    $error = $_FILES['gambar_produk']['error'];
    $tmpName = $_FILES['gambar_produk']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo  "<script>
        alert('Pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }



    //cek apakah yang diupload gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile); // -> Contoh Gambar.jpg = ['Gambar', 'jpg'];
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo  "<script>
        alert('Tolong upload berupa gambar!');
            </script>";
        return false;
    }

    //cek jika ukuran terlalu besar 
    if ($ukuranFile > 1000000) {
        echo  "<script>
        alert('Ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // gambar siap diupload
    //generate nama gambar baru 
    $namaFileBaru = uniqid();
    $namaFileBaru .=  '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, '../product_images/' . $namaFileBaru);

    return $namaFileBaru;
}
