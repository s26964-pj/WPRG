<?php
include_once '../classes/Database.php';
include_once '../classes/User.php';

session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$query = "SELECT logs.*, users.username FROM logs JOIN users ON logs.user_id = users.id ORDER BY logs.created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logi</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script src="../assets/js/script.js" defer></script>
</head>
<body>
<h1>Logi</h1>
<a href="dashboard.php" class="button">Powrót do panelu</a>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Użytkownik</th>
        <th>Akcja</th>
        <th>Data</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($row['action'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>