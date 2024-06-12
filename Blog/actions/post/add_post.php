<?php
include_once '../../classes/Database.php';
include_once '../../classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if ($_POST) {
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->image = basename($_FILES["image"]["name"]);

    if ($post->create()) {
        if ($_FILES["image"]["tmp_name"]) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/" . $post->image);
        }
        header("Location: ../../index.php");
    } else {
        echo "Nie udało się dodać wpisu.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dodaj nowy wpis</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <script src="../../assets/js/script.js" defer></script>
</head>
<body>
<h1>Dodaj nowy wpis</h1>
<form action="add_post.php" method="post" enctype="multipart/form-data">
    <label for="title">Tytuł:</label>
    <input type="text" name="title" required>
    <br>
    <label for="content">Treść:</label>
    <textarea name="content" required></textarea>
    <br>
    <label for="image">Obrazek (opcjonalnie):</label>
    <input type="file" name="image">
    <br>
    <button type="submit" class="button">Dodaj</button>
</form>
<a href="../index.php" class="button">Powrót do bloga</a>
</body>
</html>
