<?php
require 'functions.php';

session_start();

$dataProduk = query("SELECT * FROM tb_produk ORDER BY id DESC");

$_SESSION['index'] = true;

if (isset($_SESSION['login']) && isset($_SESSION['username'])) {
    $loggedInUsername = $_SESSION['username'];
} else {
    $loggedInUsername = "";
}

if (isset($_POST["submit_pesan"])) {
    if (kirimPesan($_POST) > 0) {
        echo
        "<script>
          document.location.href = 'form_response.php';
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial=1.0">
    <title>FlowerShop!</title>

    <!--- font awasome cdn link --->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!--- costum css file link --->

    <link rel="stylesheet" href="css/style.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="https://i.pinimg.com/564x/cf/af/12/cfaf12db839a6edb74e5627ede4ad9ff.jpg" type="image/x-icon">
</head>

<body>

    <!--- header section start --->

    <header>

        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fa-solid fa-bars"></label>

        <a href="#" class="logo">FlowerShop<span>.</span></a>

        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#products">Products</a>
            <a href="#review">Review</a>
            <a href="#contact">Contact</a>
        </nav>

        <div class="icons">
            <?php if (isset($_SESSION["login"])) : ?>
                <h2>Hello <?= $loggedInUsername ?>!</h2>
                <a href="logout.php" class="logout-button"><i class="fa fa-sign-out"></i></a>
            <?php else : ?>
                <a href="login.php" class="fa-solid fa-circle-user"></a>
            <?php endif ?>
        </div>

    </header>

    <!--- header section end --->

    <!--- home section start --->

    <section class="home" id="home">

        <div class="content">
            <h3>fresh flowers</h3>
            <span> natural & beautiful flowers </span>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Baetae laborum ut minus
                corrupti dolorum dolore assumenda iste voluptate dolorem pariatur.</p>
            <a href="allprod.php" class="btn">shop now</a>
        </div>

    </section>

    <!--- home section end --->

    <!--- about section start --->

    <section class="about" id="about">

        <h1 class="heading"> <span> about </span> us </h1>

        <div class="row">

            <div class="image-container">
                <img src="images/about.jpg">
                <h3>best flowers sellers</h3>
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Baetae laborum ut minus
                    corrupti dolorum dolore assumenda iste voluptate dolorem pariatur corporis
                    perspiciatis aspernatur a ullam repudiandae autem asperiores quibusdam omnis commodi alias repellat illum
                    unde optio temproibus</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium ea est
                    commodi indicidunt megni quia molestias perspicitasis unde repudiandae quidem</p>
                <a href="#" class="btn">Learn More</a>
            </div>

    </section>

    <!--- about section end --->

    <!--- icons section start --->

    <section class="icons-container">

        <div class="icons">
            <img src="images/icons 1.png">
            <div class="info">
                <h3>free delivery</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icons 2.png">
            <div class="info">
                <h3>10 days returns</h3>
                <span>moneyback guarantee</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icons 3.png">
            <div class="info">
                <h3>offer & gift</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icons 4.png">
            <div class="info">
                <h3>secure paymens</h3>
                <span>protected by paypal</span>
            </div>
        </div>

    </section>

    <!--- icons section end --->

    <!--- products section start --->

    <section class="products" id="products">

        <h1 class="heading"> latest <span>products</span> </h1>

        <div class="box-container">
            <?php foreach ($dataProduk as $produk) : ?>
                <div class="box">
                    <div class="image">
                        <img src="product_images/<?= $produk["gambar"] ?>" alt="">
                        <div class="icons">
                            <a href="allprod.php" class="cart-btn">See Product</a>
                        </div>
                    </div>
                    <div class="content">
                        <h3><?= $produk["name"] ?></h3>
                        <div class="price">Rp <?= number_format($produk["price"], 0, ".", ".") ?></div>
                    </div>
                </div>
            <?php endforeach ?>


        </div>

    </section>

    <!--- products section end --->

    <!--- review section start --->

    <section class="review" id="review">

        <h1 class="heading"> costumer's <span>review</span> </h1>

        <div class="box-container">

            <div class="box">
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                    as opposed to using 'Content here, content here', making it look like readable English.
                    Many desktop publishing packages and web page editors now use </p>
                <div class="user">
                    <img src="images/review 1.jpg" alt="">
                    <div class="user-info">
                        <h3>john dalton</h3>
                        <spsan>happy costumer</spsan>
                    </div>
                </div>
                <span class="fa-solid fa-quote-right"></span>
            </div>

            <div class="box">
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                    as opposed to using 'Content here, content here', making it look like readable English.
                    Many desktop publishing packages and web page editors now use </p>
                <div class="user">
                    <img src="images/review 2.jpg" alt="">
                    <div class="user-info">
                        <h3>axyra josheppine</h3>
                        <spsan>happy costumer</spsan>
                    </div>
                </div>
                <span class="fa-solid fa-quote-right"></span>
            </div>

            <div class="box">
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                    as opposed to using 'Content here, content here', making it look like readable English.
                    Many desktop publishing packages and web page editors now use </p>
                <div class="user">
                    <img src="images/review 3.jpg" alt="">
                    <div class="user-info">
                        <h3>alberto gabriel</h3>
                        <spsan>happy costumer</spsan>
                    </div>
                </div>
                <span class="fa-solid fa-quote-right"></span>
            </div>

            <div class="box">
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                    as opposed to using 'Content here, content here', making it look like readable English.
                    Many desktop publishing packages and web page editors now use </p>
                <div class="user">
                    <img src="images/review 4.jpg" alt="">
                    <div class="user-info">
                        <h3>grace nathaline</h3>
                        <spsan>happy costumer</spsan>
                    </div>
                </div>
                <span class="fa-solid fa-quote-right"></span>
            </div>

        </div>

    </section>

    <!--- review section end --->

    <!--- contact section start --->

    <section class="contact" id="contact">

        <h1 class="heading"> <span> Contact </span> Us </h1>

        <div class="row">

            <form action="" method="post">
                <input type="text" name="name" placeholder="Your Name..." class="box">
                <input type="email" name="email" placeholder="Your Email.." class="box">
                <input type="number" name="number" placeholder="Your Number..." class="box">
                <textarea name="message" class="box" placeholder="Message" id="" cols="30" rows="10"></textarea>
                <input type="submit" value="Send Message" class="btn" name="submit_pesan">
            </form>

            <div class="image">
                <img src="images/contact.jpg" alt="">
            </div>

        </div>

    </section>

    <!--- contact section end --->

    <!--- footer section start --->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="#">home</a>
                <a href="#">about</a>
                <a href="#">products</a>
                <a href="#">review</a>
                <a href="#">contact</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#">my account</a>
                <a href="#">my order</a>
                <a href="#">my favorite</a>
            </div>

            <div class="box">
                <h3>locations</h3>
                <a href="#">USA</a>
                <a href="#">Indonesia</a>
                <a href="#">Japanese</a>
                <a href="#">France</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#">+62 809-124-897</a>
                <a href="#">alice@gmail.com</a>
                <a href="#">japanese, tokyo - 070506</a>
            </div>

        </div>

    </section>
</body>

</html>
<!--- footer section end --->