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
        <h1>Your order is complete!</h1>
    </header>

    <h2>Your order:</h2>
    
    <div class="cart-display">
        <?php
            include('cart-build.php');
        ?>
    </div>

    <?php

        function sanitizeInput($input) {
            return htmlspecialchars($input);
            return trim($input);
            return stripslashes($input);
        }

        $address = filter_input(INPUT_POST, 'st-address', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);


        sanitizeInput($address);
        sanitizeInput($city);
        sanitizeInput($state);
        sanitizeInput($zipcode);

    ?>
    <h2>Your shipping address:</h2>
    <p>Street Address: <?php echo $address?></p>
    <p>City: <?php echo $city ?></p>
    <p>State: <?php echo $state ?></p>
    <p>Zipcode: <?php echo $zipcode ?></p>

    <a href="index.php">Back to Browsing</a>
       
        
        <script src="" async defer></script>
    </body>
</html>