<?php

include("connect.php");

$list_id = $_GET['id'];

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
       $stmt = $db->prepare('SELECT * FROM listitem JOIN list ON listitem.list_id=list.id JOIN item ON listitem.item_id=item.id WHERE listitem.list_id = :list_id');
       $stmt->bindValue(':list_id', $list_id, PDO::PARAM_INT);
       $stmt->execute();
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

       echo $list_id;

    //    foreach ($rows as $row) {
    //        $description = $row['item_description'];
    //        $amount = $row['current_amount'];
    //        $unit = $row['unit_name'];
    //        $categoryName = $row['category_name'];

    //    $searchDetails = '<ul><li>Item: ' . $description . '</li><li>Amount: ' . $amount . ' ' . $unit . '</li><li>Category: ' . $categoryName . '</li></ul>';

    //    echo $searchDetails;
    //    }

    ?>

    <h1>Current Lists</h1>
    <h4>at a glance</h4>

    

</body>
</html>