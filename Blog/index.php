<?php
include_once 'classes/Database.php';
include_once 'classes/Post.php';

session_start();

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$stmt = $post->readAll();

function getPostTitle($post_id)
{
    $database = new Database();
    $db = $database->getConnection();

    $post = new Post($db);

    $post->id = $post_id;

    $post->readOne();

    return $post->title;
}

function getLastVisitedPosts()
{
    $cookie_name = 'last_visited_posts';
    $last_visited_posts = isset($_COOKIE[$cookie_name]) ? json_decode($_COOKIE[$cookie_name], true) : [];

    $output = '<ul style="text-align: center">';
    foreach ($last_visited_posts as $post_id) {
        $post_title = getPostTitle($post_id);
        $output .= "<li><a href='post.php?id=$post_id'>$post_title</a></li>";
    }
    $output .= '</ul>';

    return $output;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
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

<h2 style="text-align: center">Ostatnie odwiedzone wpisy:</h2>
<?php echo getLastVisitedPosts(); ?>

<div class="container">
    <?php if (isset($_SESSION['username'])): ?>
        <a href="actions/post/add_post.php" class="button">Dodaj nowy wpis</a>
    <?php endif; ?>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="post">
            <h2><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?php echo htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php if ($row['image']): ?>
                <img src="images/<?php echo htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Obrazek">
            <?php endif; ?>
            <p>Opublikowano: <?php echo htmlspecialchars($row['published_at'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="post.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="button">Przeczytaj
                więcej</a>
        </div>
    <?php endwhile; ?>
</div>

<footer>
    <p>&copy; 2024 Blog</p>
</footer>
</body>
</html>
