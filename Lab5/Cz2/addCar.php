<?php
include 'config.php';

global $pdo;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO cars (brand, model, price, year, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$brand, $model, $price, $year, $description]);

    header('Location: index.php');
    exit();
}
?>

<body>
<nav>
    <a href="index.php">Main page</a>
    <a href="allCars.php">All cars</a>
    <a href="addCar.php">Add car</a>
</nav>

<h2>Add car</h2>
<form method="post">
    <label for="brand">Brand:</label>
    <input type="text" id="brand" name="brand" required><br>

    <label for="model">Model:</label>
    <input type="text" id="model" name="model" required><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" required><br>

    <label for="year">Year:</label>
    <input type="number" id="year" name="year" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>

    <input type="submit" value="Add car">
</form>