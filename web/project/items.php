<?php

include("connect.php");


$catList = "<select name='categoryId' id='categoryId'><option disabled selected value> -- select an option -- </option>";
    foreach ($db->query('SELECT id, category_name FROM category ORDER BY category_name') as $category){

        $categoryListId = $category['id'];
        $categoryName = $category['category_name'];

        $catList .= "<option value='$categoryListId'";
        
        $catList.= ">$categoryName</option>";
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
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/project/header.php'; ?>
    </header>

    <h1>Current Stocks</h1>
    <h4>at a glance</h4>

    <div class="grid">
        <div class="grid1">
            <h2>Add A New Item</h2>

            <form method="POST" action="newitem.php">
                <div class="columnFlex">
                    <label for="item">Item Name:<input type="text" name="item"></label>
                    <label for="amount">Item Amount:<input type="number" name="amount"></label>
                </div>
                <div class="rowFlex">
                <div class="radioDiv">
                    <h4>Unit:</h4>
                    <?php

                        $statement = $db->query('SELECT * FROM unit');

                        while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                        {
                            $unitId = $row['id'];
                            $name = $row['unit_name'];
                            
                            $unitList = "<label for='$unitId'><input type='radio' id='$unitId' name='unit' value='$unitId'>
                            $name</label>";

                            echo $unitList;
                        }

                    ?>
                </div>
                <div class="radioDiv">
                    <h4>Category</h4>
                    <?php

                    $statement = $db->query('SELECT * FROM category');

                    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                    {
                    $categoryId = $row['id'];
                    $categoryName = $row['category_name'];

                    $categoryList = "<label for='$categoryId'><input type='radio' id='$categoryId' name='category' value='$categoryId'>
                    $categoryName</label>";
                    echo $categoryList;
                    }

                    ?>
                </div>
                </div>
                <input type="submit" name="submitItem">
            </form>

        </div>

        <div class="grid2">
        <h2>Search by Category</h2>
            <form class="categoryForm" method="post">
                <?php echo $catList; ?>
                <input type="submit" value="Search" name="submit">
            </form>

            <?php
                if(isset($_POST['submit'])){   

                    $categoryId = $_POST['categoryId'];

                    $stmt = $db->prepare('SELECT * FROM item JOIN category ON item.category_id=category.id JOIN unit ON item.unit_id=unit.id WHERE category.id = :categoryId');
                    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if(!$rows){
                        echo '<p class="error">No items found</p>';
                    }
                    else {
                        foreach ($rows as $row) {
                            $description = $row['item_description'];
                            $amount = $row['current_amount'];
                            $unit = $row['unit_name'];
                            $categoryName = $row['category_name'];

                            $searchDetails = '<ul class="itemList"><li class="firstItem">' . $description . '</li><li>Amount: ' . $amount . ' ' . $unit . '</li><li>Category: ' . $categoryName . '</li></ul>';

                            echo $searchDetails;
                        }
                    }
                    
                }   

            ?>

        </div>


        <div class="grid3">
            <h2>All Items</h2>

            <?php
        $statement = $db->query('SELECT * FROM item JOIN category ON item.category_id=category.id JOIN unit ON item.unit_id=unit.id');

        while ($newRow = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $description = $newRow['item_description'];
            $amount = $newRow['current_amount'];
            $unit = $newRow['unit_name'];
            $categoryName = $newRow['category_name'];

            $itemDetails = '<ul><li class="firstItem">' . $description . '</li><li>Amount: ' . $amount . ' ' . $unit . '</li><li>Category: ' . $categoryName . '</li></ul>';

            echo $itemDetails;
        }

    ?>
        </div>
    </div>



    <script>
        history.pushState({}, "", "")
    </script>


</body>

</html>