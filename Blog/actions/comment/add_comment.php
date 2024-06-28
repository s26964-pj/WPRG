<?php
include_once '../../classes/Database.php';
include_once '../../classes/Comment.php';

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    die("Database connection failed.");
}

$comment = new Comment($db);

if ($_POST) {
    if (isset($_POST['post_id']) && isset($_POST['content'])) {
        $comment->post_id = $_POST['post_id'];
        $comment->content = $_POST['content'];
        $comment->user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if ($comment->create()) {
            header("Location: ../../post.php?id=" . $_POST['post_id']);
            exit();
        } else {
            echo "Nie udało się dodać komentarza.";
        }
    } else {
        echo "Post ID and content are required.";
    }
} else {
    echo "Invalid request.";
}
?>