<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cars web</title>
</head>
<body>
<nav>
    <a href="allCars.php">All cars</a>
    <a href="addCar.php">Add car</a>
</nav>
<h1>Cars web</h1>
<hr>
<?php
if (isset($_GET['page'])) {
    include($_GET['page'] . '.php');
} else {
    include('cheapestCars.php');
}
?>
</body>
</html>