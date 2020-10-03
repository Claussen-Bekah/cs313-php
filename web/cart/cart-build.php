<?php 

if (empty($_SESSION['cart'])) {
        echo "<h2>There is nothing in your cart</h2>";
       
    }

    else {
        $count = count($_SESSION['cart']);

        for ($i=0; $i < $count; $i++) { 
           $item = $products[$_SESSION['cart'][$i]];
           $name = $item["name"];
           $price = $item["price"];
           $imgPath = $item["imgPath"];

           $html = "<div class=\"cart-item\ id=\"$i\">
                    <h3>$name</h3>
                    <p>$price</p>
                    <img src=\"$imgPath\" alt=\"$name\"></img>";
            $form =  "<form method=\"post\">
                        <input type=\"text\" class=\"hidden\" value=$i name=\"cartIndex\">
                        <input type=\"submit\" value=\"Remove Item\" name=\"remove\">
                    </form>";
            $endDiv = "</div>";
            

            if(stripos($_SERVER['REQUEST_URI'], 'view-cart.php')) {
                echo $html;
                echo $form.$endDiv;
            } else {
                echo $html.$endDiv;
            }
           
        }
    
    }
    ?>