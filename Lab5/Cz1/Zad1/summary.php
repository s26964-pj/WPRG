<?php
session_start();

if (!isset($_SESSION['reservation'])) {
    header('Location: index.php');
    exit();
}

$reservation = $_SESSION['reservation'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation Summary</title>
</head>
<body>

<h2>Reservation Summary</h2>
<p>Number of Guests: <?php echo htmlspecialchars($reservation['guests']); ?></p>
<p>Full Name: <?php echo htmlspecialchars($reservation['name']); ?></p>
<p>Address: <?php echo htmlspecialchars($reservation['address']); ?></p>
<p>Credit Card Information: <?php echo htmlspecialchars($reservation['credit_card']); ?></p>
<p>Email: <?php echo htmlspecialchars($reservation['email']); ?></p>
<p>Arrival Date: <?php echo htmlspecialchars($reservation['arrival_date']); ?></p>
<p>Arrival Time: <?php echo htmlspecialchars($reservation['arrival_time']); ?></p>
<p>Child Bed: <?php echo htmlspecialchars($reservation['child_bed']); ?></p>
<p>Amenities: <?php echo !empty($reservation['amenities']) ? implode(", ", $reservation['amenities']) : 'None'; ?></p>

<h2>Guest Names:</h2>
<ul>
    <?php foreach ($reservation['guest_names'] as $index => $guest_name): ?>
        <li>Guest <?php echo $index + 1; ?>: <?php echo htmlspecialchars($guest_name); ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>
