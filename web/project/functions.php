<?php 


$catList = "<select name='categoryId' id='categoryId'><option disabled selected value> -- select an option -- </option>";
    foreach ($db->query('SELECT id, category_name FROM category ORDER BY category_name') as $category){

        $categoryListId = $category['id'];
        $categoryName = $category['category_name'];

        $catList .= "<option value='$categoryListId'";
        
        $catList.= ">$categoryName</option>";
    }
$catList .= '</select>';

$itemList = "<select name='itemId' id='itemId'><option disabled selected value> -- select an option -- </option>";
    foreach ($db->query('SELECT id, item_description FROM item ORDER BY item_description') as $item){

        $itemId = $item['id'];
        $itemName = $item['item_description'];

        $itemList .= "<option value='$itemId'";
        
        $itemList.= ">$itemName</option>";
    }
$itemList .= '</select>';


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

function newList($listName, $listDate) {

    $db = dataConnect();

    $sql = 'INSERT INTO list (list_name, creation_date)
        VALUES (:listName, :listDate)';

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':listName', $listName, PDO::PARAM_STR);
    $stmt->bindValue(':listDate', $listDate);

    $stmt->execute();

    return $db->lastInsertId("list_id_seq");

    

}

function addItem($itemId, $listId, $amount) {

    $db = dataConnect();

    $sql = 'INSERT INTO listitem (item_id, list_id, buy_amount)
        VALUES (:itemId, :listId, :amount)';

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':itemId', $itemId, PDO::PARAM_STR);
    $stmt->bindValue(':listId', $listId, PDO::PARAM_STR);
    $stmt->bindValue(':amount', $amount, PDO::PARAM_STR);


    $stmt->execute();

 
}

function deleteItem($listItemId) {

    $db = dataConnect();

    $sql = 'DELETE FROM listitem WHERE id = :listItemId';
    $stmt = $db->prepare($sql);
  
    $stmt->bindValue(':listItemId', $listItemId, PDO::PARAM_INT); 

    $stmt->execute();

}

function deleteList($listId) {

    $db = dataConnect();

    $sql = 'DELETE FROM list WHERE id = :listId';
    $stmt = $db->prepare($sql);
  
    $stmt->bindValue(':listId', $listId, PDO::PARAM_INT); 

    $stmt->execute();

}


