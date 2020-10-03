<?php 

session_start();

include("products.php");

if (! isset ( $_SESSION ['cart'] )) {
    $_SESSION ['cart'] = array();
}

function addToCart($id) {
    array_push($_SESSION['cart'], $id);
    echo "<p>Added to cart!<p>";

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
    <main>
        <header>
            <div class="title">
                <h1>Rainbow Oak</h1>
                <p>"Beautiful, wooden toys for your beautiful, wooden child." —Geppetto</p>
            </div>

            <figure class="cart-fig">
                <a href="view-cart.php"><img class="cart-img" src="images/cart.png" alt="go to cart icon">View
                    Cart</img></a>
            </figure>
        </header>
        <div class="browse-images">
            <figure>
                <img src="images/0.png" alt="animal toys for babies"></img>
                <figcaption>Beautiful animal toys, perfect for your sweet baby as she learns to grab. <form
                        method="post">

                        <input type="submit" value="Add to Cart" name="submit0">

                    </form>
                        <?php 
                            if(isset($_POST['submit0'])){                           
                                addToCart(0);
                            }                        
                        ?>
                </figcaption>

            </figure>
            <figure>
                <img src="images/1.png" alt="dinosaur stacking toy"></img>
                <figcaption>A fun stacking toy for your most adventurous child.<form method="post">
                        <input type="submit" value="Add to Cart" name="submit1">
                    </form>
                        <?php 
                            if(isset($_POST['submit1'])){
                                addToCart(1);
                            }                        
                        ?>
                </figcaption>

            </figure>

            <figure>
                <img src="images/2.png" alt="wooden puzzles"></img>
                <figcaption>Your child will delight in putting together these adorable puzzles.<form method="post">
                        <input type="submit" value="Add to Cart" name="submit2">
                    </form>
                        <?php 
                            if(isset($_POST['submit2'])){
                                addToCart(2);
                            }                            
                        ?>
                </figcaption>

            </figure>
            <figure>
                <img src="images/3.png" alt="rainbow stacking toy"></img>
                <figcaption>Sweet rainbows will fill your home with this beautiful stacking toy.<form method="post">
                        <input class="submit-btn" type="submit" value="Add to Cart" name="submit3">
                    </form>
                        <?php 
                            if(isset($_POST['submit3'])){
                                addToCart(3);
                            }                            
                        ?>
                </figcaption>

            </figure>

        </div>

    </main>




    <script>
        history.pushState({}, "", "")
    </script>
</body>

</html>