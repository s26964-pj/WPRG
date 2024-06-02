<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['reservation'] = [
        'guests' => $_POST['guests'],
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'credit_card' => $_POST['credit_card'],
        'email' => $_POST['email'],
        'arrival_date' => $_POST['arrival_date'],
        'arrival_time' => $_POST['arrival_time'],
        'child_bed' => isset($_POST['child_bed']) ? 'Yes' : 'No',
        'amenities' => isset($_POST['amenities']) ? $_POST['amenities'] : [],
        'guest_names' => []
    ];
    header('Location: guests.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation</title>
</head>
<body>

<h2>Reservation</h2>

<form method="post">
    <label for="guests">Number of Guests:</label>
    <select id="guests" name="guests" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select><br><br>

    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br><br>

    <label for="credit_card">Credit Card Information:</label>
    <input type="text" id="credit_card" name="credit_card" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="arrival_date">Arrival Date:</label>
    <input type="date" id="arrival_date" name="arrival_date" required><br><br>

    <label for="arrival_time">Arrival Time:</label>
    <input type="time" id="arrival_time" name="arrival_time" required><br><br>

    <label for="child_bed">Child Bed:</label>
    <input type="checkbox" id="child_bed" name="child_bed"><br><br>

    <label for="amenities">Amenities:</label><br>
    <input type="checkbox" id="air_conditioning" name="amenities[]" value="air_conditioning"> Air Conditioning<br>
    <input type="checkbox" id="ashtray" name="amenities[]" value="ashtray"> Ashtray<br><br>

    <input type="submit" value="Next">
</form>

</body>
</html>
