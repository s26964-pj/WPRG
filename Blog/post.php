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
$post->readOne();

$comment_stmt = $comment->readAllByPostId($post_id);

$prev_post_id = $post->getPreviousPost();
$next_post_id = $post->getNextPost();

if ($prev_post_id !== null) {
    $prev_post = new Post($db);
    $prev_post->id = $prev_post_id;
    $prev_post->readOne();
} else {
    $prev_post = null;
}

if ($next_post_id !== null) {
    $next_post = new Post($db);
    $next_post->id = $next_post_id;
    $next_post->readOne();
} else {
    $next_post = null;
}


function setLastVisitedPostsCookie($post_id) {
    $cookie_name = 'last_visited_posts';
    $expire = time() + (30 * 24 * 3600);
    $last_visited_posts = isset($_COOKIE[$cookie_name]) ? json_decode($_COOKIE[$cookie_name], true) : [];

    if (!in_array($post_id, $last_visited_posts)) {
        array_push($last_visited_posts, $post_id);
    }

    if (count($last_visited_posts) > 5) {
        array_shift($last_visited_posts);
    }

    setcookie($cookie_name, json_encode($last_visited_posts), $expire, '/');
}

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    setLastVisitedPostsCookie($post_id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
</head>
<body>
<header>
    <h1>Blog</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="contact.php">Kontakt</a>
        <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
            <a href="admin/dashboard.php">Panel Admina</a>
            <a href="actions/user/logout.php">Wyloguj się</a>
        <?php elseif (isset($_SESSION['username'])): ?>
            <a href="actions/user/logout.php">Wyloguj się</a>
        <?php else: ?>
            <a href="actions/user/login.php">Zaloguj się</a>
            <a href="actions/user/register.php">Zarejestruj się</a>
        <?php endif; ?>
    </nav>
</header>

<div class="container">
    <h1><?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></h1>
    <p><?php echo htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php if ($post->image): ?>
        <img src="images/<?php echo htmlspecialchars($post->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Obrazek">
    <?php endif; ?>
    <p>Opublikowano: <?php echo htmlspecialchars($post->published_at, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'author')): ?>
        <a href="actions/post/edit_post.php?id=<?php echo $post->id; ?> " class="button">Edytuj</a>
        <a href="actions/post/delete_post.php?id=<?php echo $post->id; ?>" class="button">Usuń</a>
    <?php endif; ?>

    <h2>Komentarze</h2>
    <?php if ($comment_stmt->rowCount() > 0): ?>
        <?php while ($comment_row = $comment_stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div>
                <p><?php echo htmlspecialchars($comment_row['content'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p>Dodano: <?php echo htmlspecialchars($comment_row['created_at'], ENT_QUOTES, 'UTF-8'); ?> przez <?php echo isset($comment_row['username']) ? htmlspecialchars($comment_row['username'], ENT_QUOTES, 'UTF-8') : 'Gość'; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Brak komentarzy.</p>
    <?php endif; ?>

    <h3>Dodaj komentarz</h3>
    <form action="actions/comment/add_comment.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post->id; ?>">
        <textarea name="content" required></textarea>
        <button type="submit" class="button">Dodaj</button>
    </form>

    <div>
        <?php if ($prev_post): ?>
            <a href="post.php?id=<?php echo $prev_post->id; ?>" class="button">&lt;&lt; Poprzedni wpis</a>
        <?php endif; ?>
        <?php if ($next_post): ?>
            <a href="post.php?id=<?php echo $next_post->id; ?>" class="button">Następny wpis &gt;&gt;</a>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Blog</p>
</footer>
</body>
</html>
