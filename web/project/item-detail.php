<?php

include("connect.php");
include("functions.php");

$list_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);;

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

                $listId = filter_input(INPUT_POST, 'listId', FILTER_SANITIZE_NUMBER_INT);

                deleteList($listId);

                header('location: list.php');
                die();
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

                    $listItemId = filter_input(INPUT_POST, 'listItemId', FILTER_SANITIZE_NUMBER_INT);
                    $listId = filter_input(INPUT_POST, 'listId', FILTER_SANITIZE_NUMBER_INT);

                    deleteListItem($listItemId);

                    header('location: item-detail.php?id=' . $listId);
                    die();
                     
                }


            ?>
        </div>
        <div class="grid2">

            <h2>Add Item to List</h2>
            <form class="categoryForm" method="POST">
                <?php echo $itemList; ?>
                <label for="date">Buy Amount:<input type="number" name="amount" required></label>
                <input type="hidden" name="listId" value="<?php echo $list_id; ?>">

                <input type="submit" name="submitItem">

            </form>

            <?php
                if(isset($_POST['submitItem'])){ 
                    

                    $itemId = filter_input(INPUT_POST, 'itemId', FILTER_SANITIZE_NUMBER_INT);
                    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
                    $listId = filter_input(INPUT_POST, 'listId', FILTER_SANITIZE_NUMBER_INT);


                    addItem($itemId, $listId, $amount);

                    header('location: item-detail.php?id=' . $listId);
                    die();
                    
                }   

            ?>

        </div>



        <script>
            history.pushState({}, "", "")
        </script>

</body>

</html>