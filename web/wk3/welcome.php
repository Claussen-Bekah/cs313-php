<!DOCTYPE html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Welcome!</title>
        <meta name="description" content="Welcome message for form submission">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

    <p>Name: <?php echo $_POST["name"]; ?> </p>
    <p>Your email address is: <a href=":mailto<?php echo $_POST["email"]; ?>"><?php echo $_POST["email"]; ?></a></p>
    <p>Your major is: <?php echo $_POST["major"]; ?></p>
    <p>Comments: <?php echo $_POST["comments"]; ?></p>

    <p>Continents: <?php 
    
    $continents = $_POST["continent"];
    $count = count($continents);
     for ($i=0; $i < $count; $i++) { 
         if ($i == $count-1) {
             echo($continents[$i]);
         }
         else
            echo($continents[$i] . ", ");
     }
     ?>

    </p>

        
        <script src="" async defer></script>
    </body>
</html>