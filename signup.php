<?php
require 'functions.php';

if (isset($_POST["submit"])) {
    if (tambahUser($_POST) > 0) {
        echo
        "<script>
            alert('User berhasil ditambahkan!');
            document.location.href = 'login.php';
        </script>";
    } else {
        echo
        "<script>
            alert('User gagal ditambahkan!');
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="https://i.pinimg.com/564x/cf/af/12/cfaf12db839a6edb74e5627ede4ad9ff.jpg" type="image/x-icon">

</head>

<body>
    <section>
        <form action="" method="post">
            <h1>Sign Up</h1>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" name="email" required>
                <label for="">Email</label>
            </div>
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
            <button type="submit" name="submit">Sign Up</button>
            <div class="register">
                <p>Already Have An Account?<a href="login.php"> Log In</a></p>
            </div>
        </form>
    </section>
</body>

</html>