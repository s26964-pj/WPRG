<?php
include_once '../../classes/Database.php';
include_once '../../classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

if ($post->delete()) {
    echo "Wpis został usunięty.";
    header("Location: ../../index.php");
} else {
    echo "Nie udało się usunąć wpisu.";
}
?>
