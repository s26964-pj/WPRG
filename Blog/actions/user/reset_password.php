<?php
include_once '../../classes/Database.php';
include_once '../../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    $user->username = $_POST['username'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    $query = "UPDATE " . $user->table_name . " SET password = :password WHERE username = :username";
    $stmt = $user->conn->prepare($query);

    $stmt->bindParam(":password", $new_password);
    $stmt->bindParam(":username", $user->username);

    if ($stmt->execute()) {
        echo "Hasło zostało zresetowane.";
    } else {
        echo "Nie udało się zresetować hasła.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resetowanie hasła</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <script src="../../assets/js/script.js" defer></script>
</head>
<body>
<header>
    <h1>Blog</h1>
    <nav>
        <a href="../../index.php">Home</a>
        <a href="../../contact.php">Kontakt</a>
    </nav>
</header>

<div class="container">
    <h1>Resetowanie hasła</h1>
    <form action="reset_password.php" method="post">
        <label for="username">Login:</label>
        <input type="text" name="username" required>
        <br>
        <label for="new_password">Nowe hasło:</label>
        <input type="password" name="new_password" required>
        <br>
        <button type="submit">Zresetuj hasło</button>
    </form>
    <a href="../../index.php">Powrót do bloga</a>
</div>

<footer>
    <p>&copy; 2023 Blog</p>
</footer>
</body>
</html>