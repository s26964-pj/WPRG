<?php
include_once '../classes/Database.php';
include_once '../classes/User.php';
include_once '../classes/Post.php';
include_once '../classes/Comment.php';

session_start();

if ($_SESSION['role'] != 'admin') {
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
</head>
<body>
<h1>Panel administracyjny</h1>
<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="../admin/view_logs.php">Logi</a>
    <a href="../actions/user/logout.php">Wyloguj</a>
</nav>

<h2>Wpisy</h2>
<a href="../actions/add_post.php">Dodaj nowy wpis</a>
<?php
$stmt = $post->readAll();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . "</h3>";
    echo "<a href='../actions/edit_post.php?id=" . $row['id'] . "'>Edytuj</a> | ";
    echo "<a href='../actions/delete_post.php?id=" . $row['id'] . "'>Usuń</a>";
    echo "</div>";
}
?>

<h2>Komentarze</h2>
<?php
$stmt = $comment->readAllByPostId($post_id);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div>";
    echo "<p>" . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . "</p>";
    echo "<p>Autor: " . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . " | " . htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') . "</p>";
    echo "</div>";
}
?>
</body>
</html>
?>