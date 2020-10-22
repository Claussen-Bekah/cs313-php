<?php
function dbconnect() {
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

$book = htmlspecialchars($_POST['book']);
$chapter = (int)(htmlspecialchars($_POST['chapter']));
$verse = (int)(htmlspecialchars($_POST['verse']));
$content = htmlspecialchars($_POST['content']);
$topicId = htmlspecialchars($_POST['topic[]']);


function addScriptures($book, $chapter, $verse, $content) {

    $db = dbconnect();

    $sql = 'INSERT INTO scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)';

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':book', $book, PDO::PARAM_STR);
    $stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);
    $stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);

    $stmt->execute();

}

function addTopics($book, $chapter, $verse) {

    $db = dbconnect();

    

    $sql = 'INSERT INTO scripturetopic (scripture_id, topic_id) VALUES ((SELECT id FROM scriptures WHERE book=:book AND chapter=:chapter AND verse=:verse), :topicId);';

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':book', $book, PDO::PARAM_STR);
    $stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);
    $stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
    $stmt->bindValue(':content', $topicId, PDO::PARAM_STR);

    $stmt->execute();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scriptures</title>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
        addScriptures($book, $chapter, $verse, $content);
    }
    ?>

    <p>Your scripture <?php echo $book . ' ' . $chapter . ':' . $verse . ' ' . $content; ?>  was submitted </p>


    
</body>
</html>

<!-- INSERT INTO scripturetopic (scripture_id, topic_id) VALUES ((SELECT id FROM scriptures WHERE book=:book AND chapter=:chapter AND verse=:verse), :topicId); -->

