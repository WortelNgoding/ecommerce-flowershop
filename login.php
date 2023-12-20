<?php
require 'koneksi.php';
require 'functions.php';

session_start();

// jika user sudah login maka user tidak bisa akses halaman login dan di redirect ke index.php
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_result = login($username, $password);

    if ($login_result === false) {
        $error = true;
    }
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
    <header>
        <a href="index.php">
            <ion-icon name="arrow-back-outline"></ion-icon> 
        </a>
    </header>
    <section>
        <form action="" method="post">
            <h1>Login</h1>
            <?php if (isset($error)) : ?>
                <div class="error">
                    <h4 style="text-align:center; color:red; margin-top: 30px; background-color: black; padding: 10px; border-radius: 10px;">Username/Password Salah</h4>
                </div>
            <?php endif ?>
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