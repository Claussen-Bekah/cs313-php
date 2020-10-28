<?php

include("connect.php");
include("functions.php");

$itemName = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
$itemNumber = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
$unitId = filter_input(INPUT_POST, 'unit', FILTER_SANITIZE_NUMBER_INT);
$categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);

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
    if(isset($_POST['submitItem'])) {
        newItem($itemName, $itemNumber, $unitId, $categoryId);
    } ?>
    <h3><?php echo $itemName?> successfully added</h3>
    <a href="items.php" class="backBtn"><-- Go Back</a>

</body>
</html>