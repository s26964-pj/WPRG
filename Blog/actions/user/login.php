<?php
include_once '../../classes/Database.php';
include_once '../../classes/User.php';

session_start();

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role;

        $user->logAction('login');

        header("Location: ../../index.php");
        exit();
    } else {
        echo "Nieprawidłowy login lub hasło.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logowanie</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <script src="../../assets/js/script.js" defer></script>
</head>
<body>
<header>
    <h1>Blog</h1>
    <nav>
        <a href="../../index.php">Home</a>
        <a href="../../contact.php">Kontakt</a>
        <a href="register.php">Rejestracja</a>
    </nav>
</header>

<div class="container">
    <h1>Logowanie</h1>
    <form action="login.php" method="post">
        <label for="username">Login:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Hasło:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" class="button">Zaloguj się</button>
    </form>
    <a href="../../index.php" class="button">Powrót do bloga</a>
</div>

<footer>
    <p>&copy; 2023 Blog</p>
</footer>
</body>
</html>