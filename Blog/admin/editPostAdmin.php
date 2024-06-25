<?php
include_once '../classes/Database.php';
include_once '../classes/Post.php';

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if ($_POST) {
    $post->id = $_POST['id'];
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->image = $_POST['image'];
    $post->published_at = $_POST['published_at'];

    if ($post->update()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Nie udało się zaktualizować wpisu.";
    }
} else {
    $post->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
    $post->readOne();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edytuj wpis</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>
<body>
<h1>Edytuj wpis</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($post->id, ENT_QUOTES, 'UTF-8'); ?>">
    <label for="title">Tytuł:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?>" required>
    <br><br>
    <label for="content">Treść:</label>
    <textarea name="content" required><?php echo htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8'); ?></textarea>
    <br><br>
    <button type="submit">Zaktualizuj</button>
</form>
</body>
</html>
