<?php
require 'koneksi.php';
require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


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

function login($username, $password)
{
    global $koneksi;

    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $password = md5($password);

    $login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);
        if ($data['level'] == "admin") {
            // Admin login
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "admin";
            $_SESSION['login'] = true;
            header("location:./admin/index.php");
            exit();
        } else if ($data['level'] == "user") {
            // Regular user login
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "user";
            $_SESSION['login'] = true;
            header("location:index.php");
            exit();
        } else {
            header("location:index.php?pesan=gagal");
            exit();
        }
    }
    return false; // Login failed
}


function tambahUser($data)
{
    global $koneksi;

    $username = htmlspecialchars($data["username"]);
    $email =  htmlspecialchars($data["email"]);
    $password =  htmlspecialchars($data["password"]);
    $password = md5($password);

    $query = "INSERT INTO tb_user VALUES ('', '$email', '$username', '$password', 'user')";

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

function editProduk($data)
{
    global $koneksi;

    $id = $data["id"];

    $nama_produk = htmlspecialchars($data["nama_produk"]);
    $harga_produk = htmlspecialchars($data["harga_produk"]);
    $deskripsi_produk = htmlspecialchars($data["deksripsi_produk"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar_produk']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $result = mysqli_query($koneksi, "SELECT gambar FROM tb_produk WHERE id = $id");
        $file = mysqli_fetch_assoc($result);

        $fileName = implode('.', $file);
        unlink('../product_images/' . $fileName);

        $gambar = upload();

        if ($gambar === false) {
            $gambar = $gambarLama;
        }
    }

    $query = "UPDATE tb_produk SET
            name = '$nama_produk',
            price = '$harga_produk',
            deskripsi = '$deskripsi_produk',
            gambar = '$gambar'
            WHERE id = $id
            ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusProduk($id)
{
    global $koneksi;

    $resultGambar = mysqli_query($koneksi, "SELECT gambar FROM tb_produk WHERE id = $id");
    $fileGambar = mysqli_fetch_assoc($resultGambar);

    $fileNameGambar = implode('.', $fileGambar);
    $locationImage = "../product_images/$fileNameGambar";

    if (file_exists($locationImage)) {
        unlink('../product_images/' . $fileNameGambar);
    }

    mysqli_query($koneksi, "DELETE FROM tb_produk WHERE id = $id");

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

function search($keyword)
{
    $query = "SELECT * FROM tb_produk
				WHERE
				name LIKE '%$keyword%'
                ";
                
    return query($query);
}

function kirimPesan($data) {
    global $koneksi;

    // name, email, number, message
    $name = htmlspecialchars($data["name"]);
    $email = htmlspecialchars($data["email"]);
    $number = htmlspecialchars($data["number"]);
    $message = htmlspecialchars($data["message"]);
    

    $query = "INSERT INTO tb_pesan_kontak VALUES ('', '$name', '$email', '$number', '$message')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
