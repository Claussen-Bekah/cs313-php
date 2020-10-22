<?php

function dataConnect() {
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



 
// newItem($itemName, $itemNumber, $unitId, $categoryId);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><?php echo $itemName?>successfully added</p>
</body>
</html>