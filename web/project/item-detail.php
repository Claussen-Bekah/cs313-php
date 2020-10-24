<?php

include("connect.php");

$list_id = $_GET['id'];

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

function deleteItem($listItemId) {

    $db = dataConnect();
    $sql = 'DELETE FROM listitem WHERE listItemId = :listItemId';
    $stmt = $db->prepare($sql);
  
    $stmt->bindValue(':listItemId', $listItemId, PDO::PARAM_INT); 

    $stmt->execute();

}

function newItem($itemId, $listId, $amount) {

    $db = dataConnect();

    $sql = 'INSERT INTO listitem (item_id, list_id, buy_amount)
        VALUES (:itemId, :listId, :amount)';

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':itemId', $itemId, PDO::PARAM_STR);
    $stmt->bindValue(':listId', $listId, PDO::PARAM_STR);
    $stmt->bindValue(':amount', $amount, PDO::PARAM_STR);


    $stmt->execute();

 
}

?>
<!DOCTYPE html>
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

    <h1>Your Grocery List</h1>

    <?php
       $stmt = $db->prepare('SELECT * FROM listitem JOIN list ON listitem.list_id=list.id JOIN item ON listitem.item_id=item.id WHERE listitem.list_id = :list_id');
       $stmt->bindValue(':list_id', $list_id, PDO::PARAM_INT);
       $stmt->execute();
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$rows){
            echo '<p class="error">No items found</p>';
        }
        else {

            foreach ($rows as $row) {
                $description = $row['item_description'];
                $toBuy = $row['buy_amount'];
                $listItemId = $row['id'];

            $searchDetails = '<ul class="itemList"><li>Item: ' . $description . '</li><li>Buy Amount: ' . $toBuy . '</li><li><form method="POST"><input type="submit" name="deleteItem" value="Delete"><input type="hidden" name="listItemId" value="'. $listItemId . '">
            </form></li></ul>';

            echo $searchDetails;
       }
    }

    ?>

    <?php
                if(isset($_POST['deleteItem'])){ 

                    $listItemId = $_POST['listItemId'];

                    deleteItem($listItemId);
                    
                }


    ?>

<form class="categoryForm" method="POST">
        <?php echo $itemList; ?>
        <label for="date">Buy Amount:<input type="number" name="amount"></label>
        <input type="hidden" name="listId" value="<?php echo $list_id; ?>">

        <input type="submit" name="submitItem">

    </form>

    <?php
                if(isset($_POST['submitItem'])){ 
                    

                    $itemId = $_POST['itemId'];
                    $amount = $_POST['amount'];
                    $listId = $_POST['listId'];


                    newItem($itemId, $list_id, $amount);
                    
                }   

    ?>

   

<script>
        history.pushState({}, "", "")
    </script>

</body>
</html>