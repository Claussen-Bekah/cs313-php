<?php

include("connect.php");

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

    <?php
        $statement = $db->query('SELECT id, list_name, creation_date FROM list');

        while ($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $listId = $row['id'];
            $listName = $row['list_name'];
            $creationDate = $row['creation_date'];
        }

        $listDisplayId = $_POST[$listId];

        // $stmt = $db->prepare('SELECT * FROM listitem WHERE list_id=:listDisplayId');
        // $stmt->bindValue(':listDisplayId ', $listDisplayId , PDO::PARAM_INT);
        // $stmt->execute();
        // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        echo $listDisplayId;

    ?>

    <h1>Current Lists</h1>
    <h4>at a glance</h4>

    

</body>
</html>