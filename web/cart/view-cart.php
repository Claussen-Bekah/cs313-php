<?php

session_start();

include("products.php");

function removeFromCart($id) {
    array_splice($_SESSION['cart'], $id, 1);
}

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Browse Wooden Toys</title>
    <meta name="description" content="Purchase wooden toys for your wee babbie">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&family=Sansita+Swashed&display=swap" rel="stylesheet">
</head>

<body>
    <header>

        <h1>Your Cart</h1>

    </header>
    <div class="cart-display">

        <?php
        
            if(isset($_POST['remove'])){
                removeFromCart($_POST['cartIndex']);
            }
            
            include('cart-build.php');

        ?>

    </div>

    <footer>
        <a href="index.php">Keep Browsing</a>

        <a href="checkout.php">Go to Checkout</a>
    </footer>


    <script>
        history.pushState({}, "", "")
    </script>
</body>

</html>