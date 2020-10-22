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
 


$itemName = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
$itemNumber = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_STRING);
$unitId = filter_input(INPUT_POST, 'unit', FILTER_SANITIZE_STRING);
$categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

function newItem($itemName, $itemNumber, $unitId, $categoryId) {

    $db = dataConnect();

    $sql = 'INSERT INTO item (item_description, current_amount, unit_id, category_id)
        VALUES (:itemName, :itemNumber, :unitId, :categoryId)';

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':itemName', $itemName, PDO::PARAM_STR);
    $stmt->bindValue(':itemNumber', $itemNumber, PDO::PARAM_STR);
    $stmt->bindValue(':unitId', $unitId, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);

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
    <?php
    if(isset($_POST['submitItem'])) {
        newItem($itemName, $itemNumber, $unitId, $categoryId);
    } ?>
    <h2><?php echo $itemName?> successfully added</h2>
    <a href="items.php" class="backBtn"><-- Go Back</a>
</body>
</html>