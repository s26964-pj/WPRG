<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kontakt</title>
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
    <h2>Kontakt</h2>
    <p>Możesz się ze mną skontaktować pod adresem: s26964@pjwstk.edu.pl</p>
</div>

<footer>
    <p>&copy; 2024 Blog</p>
</footer>
</body>
</html>