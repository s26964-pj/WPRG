<?php
include_once '../classes/Database.php';
include_once '../classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if ($_POST) {
    $post->id = $_POST['id'];
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->image = basename($_FILES["image"]["name"]);

    if ($post->update()) {
        if ($_FILES["image"]["tmp_name"]) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $post->image);
        }
        echo "Wpis został zaktualizowany.";
    } else {
        echo "Nie udało się zaktualizować wpisu.";
    }
} else {
    $post->id = $_GET['id'];
    $stmt = $post->readAll();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edytuj wpis</title>
</head>
<body>
<h1>Edytuj wpis</h1>
<form action="edit_post.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="title">Tytuł:</label>
    <input type="text" name="title" value="<?php echo $row['title']; ?>" required>
    <br>
    <label for="content">Treść:</label>
    <textarea name="content" required><?php echo $row['content']; ?></textarea>
    <br>
    <label for="image">Obrazek (opcjonalnie):</label>
    <input type="file" name="image">
    <br>
    <button type="submit">Zaktualizuj</button>
</form>
<a href="../index.php">Powrót do bloga</a>
</body>
</html>
?>
