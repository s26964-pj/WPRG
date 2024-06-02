<?php
include 'config.php';

global $pdo;

$stmt = $pdo->query("SELECT * FROM cars ORDER BY price ASC LIMIT 5");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>The cheapest cars</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Price</th>
    </tr>
    <?php foreach ($cars as $car): ?>
        <tr>
            <td><?php echo htmlspecialchars($car['id']); ?></td>
            <td><?php echo htmlspecialchars($car['brand']); ?></td>
            <td><?php echo htmlspecialchars($car['model']); ?></td>
            <td><?php echo htmlspecialchars($car['price']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>