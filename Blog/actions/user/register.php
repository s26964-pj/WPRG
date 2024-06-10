<?php
include_once '../../classes/Database.php';
include_once '../../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    $user->username = $_POST['username'];
    $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user->role = 'user';

    if ($user->register()) {
        echo "Rejestracja zakończona sukcesem.";
    } else {
        echo "Nie udało się zarejestrować użytkownika.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rejestracja</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <script src="../../assets/js/script.js" defer></script>
</head>
<body>
<header>
    <h1>Blog</h1>
    <nav>
        <a href="../../index.php">Home</a>
        <a href="../../contact.php">Kontakt</a>
        <a href="login.php">Logowanie</a>
    </nav>
</header>

<div class="container">
    <h1>Rejestracja</h1>
    <form action="register.php" method="post">
        <label for="username">Login:</label>
        <input type="text" name="username" required>
        <br><br>
        <label for="password">Hasło:</label>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit" class="button">Zarejestruj się</button>
    </form>
    <a href="../../index.php" class="button">Powrót do bloga</a>
</div>

<footer>
    <p>&copy; 2023 Blog</p>
</footer>
</body>
</html>