<?php
include_once 'classes/Database.php';
include_once 'classes/Post.php';
include_once 'classes/Comment.php';

session_start();

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$comment = new Comment($db);

$post_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$post->id = $post_id;
$post_stmt = $post->readAll();
$post_row = $post_stmt->fetch(PDO::FETCH_ASSOC);

$comment_stmt = $comment->readAllByPostId($post_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($post_row['title'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
</head>
<body>
<header>
    <h1>Blog</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="contact.php">Kontakt</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="admin/dashboard.php">Panel Admina</a>
            <a href="actions/user/logout.php">Wyloguj się</a>
        <?php else: ?>
            <a href="actions/user/login.php">Zaloguj się</a>
            <a href="actions/user/register.php">Zarejestruj się</a>
        <?php endif; ?>
    </nav>
</header>

<div class="container">
    <h1><?php echo htmlspecialchars($post_row['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <p><?php echo htmlspecialchars($post_row['content'], ENT_QUOTES, 'UTF-8'); ?></p>
    <?php if ($post_row['image']): ?>
        <img src="images/<?php echo htmlspecialchars($post_row['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Obrazek">
    <?php endif; ?>
    <p>Opublikowano: <?php echo htmlspecialchars($post_row['published_at'], ENT_QUOTES, 'UTF-8'); ?></p>
    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'author'): ?>
        <a href="actions/post/edit_post.php?id=<?php echo $post_row['id']; ?>">Edytuj</a>
        <a href="actions/post/delete_post.php?id=<?php echo $post_row['id']; ?>">Usuń</a>
    <?php endif; ?>

    <h2>Komentarze</h2>
    <?php while ($comment_row = $comment_stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <div>
            <p><?php echo htmlspecialchars($comment_row['content'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Dodano: <?php echo htmlspecialchars($comment_row['created_at'], ENT_QUOTES, 'UTF-8'); ?> przez <?php echo isset($comment_row['username']) ? htmlspecialchars($comment_row['username'], ENT_QUOTES, 'UTF-8') : 'Gość'; ?></p>
        </div>
    <?php endwhile; ?>

    <h3>Dodaj komentarz</h3>
    <form action="actions/comment/add_comment.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_row['id']; ?>">
        <textarea name="content" required></textarea>
        <button type="submit">Dodaj</button>
    </form>
</div>

<footer>
    <p>&copy; 2023 Blog</p>
</footer>
</body>
</html>
?>