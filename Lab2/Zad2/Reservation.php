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

    <input type="submit" name="submit" value="Reserve">
</form>

<?php
if(isset($_POST['submit'])) {
    echo "<h2>Reservation Summary:</h2>";
    echo "Number of Guests: " . $_POST['guests'] . "<br>";
    echo "Full Name: " . $_POST['name'] . "<br>";
    echo "Address: " . $_POST['address'] . "<br>";
    echo "Credit Card Information: " . $_POST['credit_card'] . "<br>";
    echo "Email: " . $_POST['email'] . "<br>";
    echo "Arrival Date: " . $_POST['arrival_date'] . "<br>";
    echo "Arrival Time: " . $_POST['arrival_time'] . "<br>";
    echo "Child Bed: ";
    if(isset($_POST['child_bed'])) {
        echo "Yes<br>";
    } else {
        echo "No<br>";
    }
    echo "Amenities: ";
    if(isset($_POST['amenities'])) {
        echo implode(", ", $_POST['amenities']);
    } else {
        echo "None";
    }
}
?>

</body>
</html>