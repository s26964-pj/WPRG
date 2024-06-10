<?php
include_once '../classes/Database.php';
include_once '../classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

if ($post->delete()) {
    echo "Wpis został usunięty.";
} else {
    echo "Nie udało się usunąć wpisu.";
}
?>
<a href="../index.php">Powrót do bloga</a>
