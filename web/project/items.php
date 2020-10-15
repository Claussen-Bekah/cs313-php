<?php

session_start();

include("connect.php");

$_SESSION['item'] = array();


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
    <?php include $_SERVER['DOCUMENT_ROOT'] . 'header.php'; ?>
</header>

<h1>Current Stocks</h1>
<h4>at a glance</h4>

<?php
$statement = $db->query('SELECT * FROM item JOIN category, unit ON item.category_id=category.id AND item.unit_id=unit.id');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo '<ul><li>Item: ' . $row['item_description'] . '</li><li>Amount: ' . $row['current_amount'] . ' ' . $row['unit_name'] . '</li><li>Category: ' . $row['category_name'] . '</li></ul>';
}
?>



</body>

</html>