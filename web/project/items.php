<?php



include("connect.php");


$catList = "<select name='categoryId' id='categoryId'>";
    foreach ($db->query('SELECT id, category_name FROM category') as $category){

        $catList .= "<option value='$category[id]'";
        
        $catList.= ">$category[category_name]</option>";
    }
$catList .= '</select>';


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
$statement = $db->query('SELECT * FROM item JOIN category ON item.category_id=category.id JOIN unit ON item.unit_id=unit.id');
$description = $row['item_description'];
$amount = $row['current_amount'];
$unit = $row['unit_name'];
$categoryName = $row['category_name'];

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  $itemDetails = '<ul><li>Item: ' . $description . '</li><li>Amount: ' . $amount . ' ' . $unit . '</li><li>Category: ' . $categoryName . '</li></ul>';

  echo $itemDetails;
}

?> 

<form method="post">
    <label for="categoryId">Search by Category:</label>
    <?php
        echo $catList;
    ?>
    <input type="submit" value="Search" name="submit">
</form>

<?php
    // if(isset($_POST['submit'])){                           
    //     echo ;
    // }   

?>





</body>

</html>