<?php
include_once '../classes/Database.php';
include_once '../classes/Comment.php';

session_start();

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

$comment->id = $_GET['id'];

if ($comment->delete()) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Nie udało się usunąć komentarza.";
}
?>
