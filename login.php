<?php
require 'koneksi.php';


// menangkap data yang dikirim dari form login
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password = md5($password);
    // menyeleksi data user dengan username dan password yang sesuai
    $login = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username= '$username' and password= '$password'");
    //menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($login);
    // cek apakah username dan password ditemukan pada database
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);
        //cek jika user login sebagai admin
        if ($data['level'] == "admin") {
            // buat session login dan username 
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "admin";
            $_SESSION['Login'] = true;
            // alihkan ke halaman dashbord admin
            header("location:./admin/index.php");
        } else if ($data['level'] == "user") {
            // buat session login dan username
            $_SESSION['username'] = $username;
            $_SESSION['level'] = "user";
            $_SESSION['Login'] = true;
            // alihkan ke halaman index
            header("location:index.php");
        } else {
            header("location:index.php?pesan=gagal");
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="https://i.pinimg.com/564x/cf/af/12/cfaf12db839a6edb74e5627ede4ad9ff.jpg" type="image/x-icon">

</head>

<body>
    <section>
        <form action="" method="post">
            <h1>Login</h1>
            <div class="inputbox">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" name="username" required>
                <label for="">Username</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <button type="submit" name="login">Log in</button>
            <div class="register">
                <p>Don't Have An Account?<a href="signup.php"> Sign Up</a></p>
            </div>
        </form>
    </section>
</body>

</html>