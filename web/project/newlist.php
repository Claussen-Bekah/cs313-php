<?php

function dataConnect() {

    $db = NULL;

    try
        {
        $dbUrl = getenv('DATABASE_URL');

        $dbOpts = parse_url($dbUrl);

        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"],'/');

        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch (PDOException $ex)
        {
        echo 'Error!: ' . $ex->getMessage();
    die();
    }

    return $db;
}
 

// $itemList = "<select name='itemId' id='itemId'><option disabled selected value> -- select an option -- </option>";
//     foreach ($db->query('SELECT id, item_description FROM item ORDER BY item_description') as $item){

//         $itemId = $item['id'];
//         $itemName = $item['item_description'];

//         $itemList .= "<option value='$itemId'";
        
//         $itemList.= ">$itemName</option>";
//     }
// $itemList .= '</select>';


// $listName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
// $listDate = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);

// function newList($listName, $listDate) {

//     $db = dataConnect();

//     $sql = 'INSERT INTO list (list_name, creation_date)
//         VALUES (:listName, :listDate)';

//     $stmt = $db->prepare($sql);
   
//     $stmt->bindValue(':listName', $listName, PDO::PARAM_STR);
//     $stmt->bindValue(':listDate', $listDate, PDO::PARAM_STR);

//     $stmt->execute();

//     $listId = $db->lastInsertId("id_seq");

 
// }

// function newItem($itemId, $listId) {

//     $db = dataConnect();

//     $sql = 'INSERT INTO listitem (item_id, list_id)
//         VALUES (:itemId, :listId)';

//     $stmt = $db->prepare($sql);
   
//     $stmt->bindValue(':itemId', $itemId, PDO::PARAM_STR);
//     $stmt->bindValue(':listId', $listId, PDO::PARAM_STR);

//     $stmt->execute();

 
// }



?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cache | Food Storage Management</title>

    <link rel="icon" href="images/favicon.png" type="image" sizes="16x16">

    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/project/header.php'; ?>
    </header>

    <?php
    if(isset($_POST['submit'])) {
        newList($listName, $listDate);
    } ?>
    <h2><?php echo $listName?> successfully added</h2>

    <h2>Add Items to List</h2>

    <form class="categoryForm" method="POST">
        <?php echo $itemList; ?>
        <label for="date">Buy Amount:<input type="number" name="amount"></label>

        <input type="submit" name="submit">

    </form>

    <?php
                if(isset($_POST['submit'])){   

                    $itemId = $_POST['itemId'];

                    newItem($itemId, $listId);
                    
                }   

            ?>

    <a href="list.php" class="backBtn"><-- Go Back</a>
    
</body>
</html>