<?php
include 'config.php';

global $pdo;

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    echo "Car does not exist!";
    exit();
}
?>
<body>
<nav>
    <a href="index.php">Main page</a>
    <a href="allCars.php">All cars</a>
    <a href="addCar.php">Add car</a>
</nav>
<h2>Car details</h2>
<p>ID: <?php echo htmlspecialchars($car['id']); ?></p>
<p>Brand: <?php echo htmlspecialchars($car['brand']); ?></p>
<p>Model: <?php echo htmlspecialchars($car['model']); ?></p>
<p>Price: <?php echo htmlspecialchars($car['price']); ?></p>
<p>Year: <?php echo htmlspecialchars($car['year']); ?></p>
<p>Description: <?php echo htmlspecialchars($car['description']); ?></p>