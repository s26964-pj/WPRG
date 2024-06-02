<?php
session_start();

if (!isset($_SESSION['reservation']['guests'])) {
    header('Location: index.php');
    exit();
}

$guests = $_SESSION['reservation']['guests'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    for ($i = 1; $i <= $guests; $i++) {
        $_SESSION['reservation']['guest_names'][] = $_POST["guest_$i"];
    }
    header('Location: summary.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guest Details</title>
</head>
<body>

<h2>Guest Details</h2>

<form method="post">
    <?php for ($i = 1; $i <= $guests; $i++): ?>
        <label for="guest_<?php echo $i; ?>">Guest <?php echo $i; ?> Name:</label>
        <input type="text" id="guest_<?php echo $i; ?>" name="guest_<?php echo $i; ?>" required><br><br>
    <?php endfor; ?>
    <input type="submit" value="Next">
</form>

</body>
</html>
