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
        echo "Komentarz został dodany.";
    } else {
        echo "Nie udało się dodać komentarza.";
    }
}
?>
<a href="../../post.php?id=<?php echo $_POST['post_id']; ?>" , class="button">Powrót do wpisu</a>