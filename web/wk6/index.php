<?php
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="scriptures.php">
        
        Book:<input type='text' name='book' id='book'>
        Chapter:<input type='text' name='chapter' id='chapter'>
        Verse:<input type="text" name='verse' id='verse'>
        Content:<input type='textarea' name='content' id='content'>

        <?php

            $statement = $db->query('SELECT * FROM topic');

            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $topicListId = $row['id'];
                $name = $row['name'];

                $topicList = "<input type='checkbox' id='$topicListId' name='topic[]' value='$topicListId'>
                <label for='$name'>$name</label>";
                echo $topicList;
            }

        ?>

        <input type='submit' name='submit'>
    </form>
    
</body>
</html>