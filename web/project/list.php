<?php

include("connect.php");
include("functions.php");


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

    <h1>Current Lists</h1>
    <h4>at a glance</h4>

    <div class="grid">
        <div class="grid1">
    <?php
        $statement = $db->query('SELECT id, list_name, creation_date FROM list');

        while ($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $listId = $row['id'];
            $listName = $row['list_name'];
            $creationDate = $row['creation_date'];

            $itemDetails = '<ul class="itemList"><li>Name: ' . $listName . '</li><li>Date Created: ' . $creationDate. '</li><li><a href="item-detail.php?id=' . $listId . '">See List Details</a></li></ul>';

            echo $itemDetails;
        }

    ?>
    </div>

    <div class="grid2">
    <h2>Add New List</h2>
    <form method="POST" action="newlist.php">
        <label for="name">Grocery List Name:<input type="text" name="name"></label>

        <input type="submit" name="submit">

    </form>
    </div>
    </div>

</body>
</html>