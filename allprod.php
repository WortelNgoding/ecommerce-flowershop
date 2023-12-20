<?php

require 'functions.php';

session_start();

$dataProduk = query("SELECT * FROM tb_produk");

$jsonData = json_encode($dataProduk);

// Pass JSON Data using tag script
echo "<script>window.productsData = $jsonData;</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="css/allprod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Money Alpine -->
    <script defer src="https://unpkg.com/alpinejs-money@latest/dist/money.min.js"></script>
    <!-- App -->
    <script src="src/app.js" async></script>


    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="`${process.env.CLIENT_KEY}`"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="https://i.pinimg.com/564x/cf/af/12/cfaf12db839a6edb74e5627ede4ad9ff.jpg" type="image/x-icon">
</head>

<body>
    <section class="products" id="products">

        <!--- header section start --->

        <header x-data>
            <!--- logo --->
            <a href="#" class="logo"><i class="fa-sharp fa-regular fa-flower-tulip"></i> Our Products</a>

            <div id="menu" class="fa-solid fa-bars"></div>

            <nav class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#about">About</a></li>
                    <li><a class="active" href="#product">Product</a></li>
                    <li><a href="index.php#review">Review</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                    <li>
                        <a href="#" id="shopping-cart-button">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="quantity-badge" x-show="$store.cart.quantity" x-text="$store.cart.quantity"></span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Shopping cart start -->
            <div class="shopping-cart">
                <template x-for="(item, index) in $store.cart.items" x-key="index">
                    <div class="cart-item">
                        <img :src="`./product_images/${item.gambar}`" :alt="item.name">
                        <div class="item-detail">
                            <h3 x-text="item.name"></h3>
                            <div class="item-price">
                                <span x-text="rupiah(item.price)"></span> &times;
                                <button id="remove" @click="$store.cart.remove(item.id)">&minus;</button>
                                <span x-text="item.quantity"></span>
                                <button id="add" @click="$store.cart.add(item)">&plus;</button> &equals;
                                <span x-text="rupiah(item.total)"></span>
                            </div>
                        </div>
                    </div>
                </template>
                <h4 x-show="!$store.cart.items.length" style="margin-top: 1rem;">Cart is empty!</h4>
                <h4 x-show="$store.cart.items.length">Total : <span x-text="rupiah($store.cart.total)"></span></h4>

                <div x-show="$store.cart.items.length" class="form-container">
                    <form action="" id="checkoutForm">
                        <input type="hidden" name="items" x-model="JSON.stringify($store.cart.items)">
                        <input type="hidden" name="total" x-model="$store.cart.total">
                        <h5>Customer Detail</h5>

                        <label for="name">
                            <span>Name</span>
                            <input type="text" name="name" id="name">
                        </label>
                        <label for="email">
                            <span>Email</span>
                            <input type="email" name="email" id="email">
                        </label>
                        <label for="phone">
                            <span>Phone</span>
                            <input type="number" name="phone" id="phone" autocomplete="off">
                        </label>

                        <button class="checkout-button disabled" type="submit" id="checkout-button" value="checkout">Checkout</button>
                    </form>
                </div>
            </div>
            <!-- Shopping cart end -->

        </header>

        <!--- search bar start --->
        <form action="" method="POST" class="search-form">
            <input type="search" name="search" placeholder="search here.." autocomplete="off">
            <label for="search-box" class="bi bi-search"></label>
        </form>
        <!--- search bar end --->

        <!--- header section end --->
        <h1 class="heading">Products</h1>

        <div class="box-container products" id="products" x-data="products">
            <template x-for="(item, index) in items" x-key="index">
                <div class="box">
                    <div class="image">
                        <img :src="`product_images/${item.gambar}`" :alt="`${item.nama}`">
                        <div class="icons">
                            <a :href="`detailprod.php?id=${item.id}`" class="fa-solid fa-eye item-detail-button"></a>
                            <?php if (isset($_SESSION["login"])) : ?>
                                <a href="#" class="fa-solid fa-bag-shopping" @click.prevent="$store.cart.add(item)"></a>
                            <?php else : ?>
                                <a href="login.php" class="fa-solid fa-bag-shopping"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="content">
                        <h3 x-text="item.name"></h3>
                        <div x-text="rupiah(item.price)" class="price"></div>
                    </div>
                </div>
            </template>
        </div>
    </section>

    <script src="js/script.js"></script>
    <script type="module">
        import 'dotenv/config';
    </script>


</body>


</html>