<?php

include("connect.php");
include("functions.php");

$listName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$listDate = date("Y/m/d");
$listId;



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
       $listId = newList($listName, $listDate);
        echo "<h3>$listName successfully added</h3>";
    } ?>

    <h4>Add Items to List</h4>

    <form class="categoryForm" method="POST">
        <?php echo $itemList; ?>
        <label for="date">Buy Amount:<input type="number" name="amount"></label>
        <input type="hidden" name="listId" value="<?php echo $listId; ?>">

        <input type="submit" name="submitItem">

    </form>

    <?php
                if(isset($_POST['submitItem'])){ 
                    

                    $itemId = filter_input(INPUT_POST, 'itemId', FILTER_SANITIZE_NUMBER_INT);
                    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
                    $listId = filter_input(INPUT_POST, 'listId', FILTER_SANITIZE_NUMBER_INT);;


                    addItem($itemId, $listId, $amount);

                    header('location: item-detail.php?id=' . $listId);
                    die();
                    
                }   

            ?>

    <a href="list.php" class="backBtn"><-- Go Back</a>

    <script>
        history.pushState({}, "", "")
    </script>
    
</body>
</html>