<?php

include("connect.php");
include("functions.php");

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

    <h1>Your Grocery List</h1>
    <div class="grid">
        <div class="grid1">
    <?php
       $stmt = $db->prepare('SELECT *, listitem.id AS listitem_id FROM listitem JOIN list ON listitem.list_id=list.id JOIN item ON listitem.item_id=item.id WHERE listitem.list_id = :list_id');
       $stmt->bindValue(':list_id', $list_id, PDO::PARAM_INT);
       $stmt->execute();
       $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$rows){
            echo '<p class="error">No items found</p>';
            echo '<h4>Delete List?</h4><form method="POST"><input class="deleteBtn" type="submit" name="deleteList" value="Delete"><input type="hidden" name="listId" value="'. $list_id . '">
            </form>';

            if(isset($_POST['deleteList'])){ 

                $listId = $_POST['listId'];

                deleteList($listId);

                header('location: list.php');
            }

        }
        else {

            foreach ($rows as $row) {
                $description = $row['item_description'];
                $toBuy = $row['buy_amount'];
                $listItemId = $row['listitem_id'];

            $searchDetails = '<ul class="itemList"><li>Item: ' . $description . '</li><li>Buy Amount: ' . $toBuy . '</li><li><form method="POST"><input class="deleteBtn" type="submit" name="deleteListItem" value="Delete"><input type="hidden" name="listItemId" value="'. $listItemId . '"><input type="hidden" name="listId" value="'. $list_id . '">
            </form></li></ul>';

            echo $searchDetails;
       }
    }

    ?>

            <?php
                if(isset($_POST['deleteListItem'])){ 

                    $listItemId = $_POST['listItemId'];
                    $listId = $_POST['listId'];

                    deleteListItem($listItemId);

                    header('location: item-detail.php?id=' . $listId);
                     
                }


            ?>
        </div>
        <div class="grid2">

            <h2>Add Item to List</h2>
            <form class="categoryForm" method="POST">
                <?php echo $itemList; ?>
                <label for="date">Buy Amount:<input type="number" name="amount"></label>
                <input type="hidden" name="listId" value="<?php echo $list_id; ?>">

                <input type="submit" name="submitItem">

            </form>

            <?php
                if(isset($_POST['submitItem'])){ 
                    

                    $itemId = $_POST['itemId'];
                    $amount = $_POST['amount'];
                    $listId = $_POST['listId'];


                    addItem($itemId, $listId, $amount);

                    header('location: item-detail.php?id=' . $listId);

                    
                }   

            ?>

        </div>
        <div class="grid3">
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

                        $statement = $db->query('SELECT * FROM unit ORDER BY unit_name');

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

                    $statement = $db->query('SELECT * FROM category ORDER BY category_name');

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



        <script>
            history.pushState({}, "", "")
        </script>

</body>

</html>