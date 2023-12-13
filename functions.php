<?php
require 'koneksi.php';

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
