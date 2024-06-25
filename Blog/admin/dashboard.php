<?php
include_once '../classes/Database.php';
include_once '../classes/User.php';
include_once '../classes/Post.php';
include_once '../classes/Comment.php';

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$post = new Post($db);
$comment = new Comment($db);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel administracyjny</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script src="../assets/js/script.js" defer></script>
</head>
<body>
<h1>Panel administracyjny</h1>

<h2 style="padding-left: 10px">Posty</h2>
<?php
$stmt = $post->readAll();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div style='border:1px solid black; max-width: 500px; margin-left: 10px; border-radius: 8px;'>";
    echo "<div>";
    echo "<h3>" . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . "</h3>";
    echo "<a href='editPostAdmin.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "' class='button'>Edytuj</a> | ";
    echo "<a href='deletePostAdmin.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "' class='button'>Usuń</a>";
    echo "</div>";

    echo "<h4>Komentarze</h4>";
    $comment_stmt = $comment->readAllByPostId($row['id']);

    if ($comment_stmt->rowCount() > 0) {
        while ($comment_row = $comment_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div>";
            echo "<p>" . htmlspecialchars($comment_row['content'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p>Autor: " . (isset($comment_row['username']) ? htmlspecialchars($comment_row['username'], ENT_QUOTES, 'UTF-8') : 'Gość') . " | " . htmlspecialchars($comment_row['created_at'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "</div>";
            echo "<a href='deleteCommentAdmin.php?id=" . $comment_row['id'] . "' class='button'>Usuń komentarz</a>";
        }
    } else {
        echo "<p>Brak komentarzy.</p>";
    }
    echo "</div>";
    echo "<br><br>";
}
?>

<a href="../admin/view_logs.php " class="button">Logi</a>
<br><br>
<a href="../index.php" class="button">Powrót</a>
</body>
</html>
