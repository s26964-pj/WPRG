<?php
include_once '../../classes/Database.php';
include_once '../../classes/Comment.php';

session_start();

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

if ($_POST) {
    $comment->post_id = $_POST['post_id'];
    $comment->content = $_POST['content'];
    $comment->user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if ($comment->create()) {
        header("Location: ../../post.php?id=" . $_POST['post_id']);
        exit();
    } else {
        echo "Nie udało się dodać komentarza.";
    }
}
?>
