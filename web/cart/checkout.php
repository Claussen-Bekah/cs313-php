<?php

session_start();

include("products.php");




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
        <h1>Checkout</h1>
        <figure class="cart-fig">
            <a href="view-cart.php"><img class="cart-img" src="images/cart.png" alt="go to cart icon">Return to Cart</img></a>
        </figure>
    </header>

    <div class="cart-display">
        <?php
            include('cart-build.php');
        ?>
    </div>

    <div class="checkout-form">
        <h3>Shipping address:</h3>
        <form action="confirm.php" method="post">
            <label for="st-address">Street Address:</label>
            <input type="text" id="st-address" name="st-address">

            <label for="city">City</label>
            <input type="text" id="city" name="city">

            <label for="state">State:</label>
            <select id="state" name="state">
                <option value="Idaho">Idaho</option>
                <option value="Idaho">Utah</option>
                <option value="Idaho">Arizona</option>
            </select>

            <div class="zip">
                <label for="zipcode">Zipcode:</label>
                <input type="text" id="zipcode" name="zipcode">
            </div>

            <input type="submit" value="Complete Purchase">
        </form>
    </div>




    <script src="" async defer></script>
</body>

</html>