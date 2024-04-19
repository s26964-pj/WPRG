<!DOCTYPE html>
<html>
<head>
    <title>Reservation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#num_of_guests").on("input", function(){
                generateGuestInputs($(this).val());
            });

            function generateGuestInputs(num_of_guests) {
                num_of_guests = parseInt(num_of_guests);
                var html = "";
                for(var i = 1; i <= num_of_guests; i++) {
                    html += generateInput("Full name for person " + i, "name_" + i);
                    html += generateInput("Email for person " + i, "email_" + i);
                }
                $("#guest_fields").html(html);
            }

            function generateInput(labelText, inputName) {
                return `<label for='${inputName}'>${labelText}:</label>
                    <input type='text' name='${inputName}' id='${inputName}' required>
                    <br>`;
            }
        });
    </script>
</head>
<body>

<h2>Reservation</h2>

<form method="post">
    <label for="num_of_guests">Number of Guests:</label>
    <select id="num_of_guests" name="num_of_guests" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select><br><br>

    <div id="guest_fields">
        <label for="name_1">Full name for person 1:</label>
        <input type="text" name="name_1" id="name_1" required><br><br>

        <label for="email_1">Email for person 1:</label>
        <input type="email" name="email_1" id="email_1" required><br><br>
    </div>

    <label for="credit_card">Credit Card Information:</label>
    <input type="text" id="credit_card" name="credit_card" required><br><br>

    <label for="arrival_date">Arrival Date:</label>
    <input type="date" name="arrival_date" id="arrival_date" required><br><br>

    <label for="departure_date">Departure Date:</label>
    <input type="date" name="departure_date" id="departure_date" required><br><br>

    <label for="arrival_time">Arrival Time:</label>
    <input type="time" name="arrival_time" id="arrival_time" required><br><br>

    <label for="child_bed">Child Bed:</label>
    <input type="checkbox" name="child_bed" id="child_bed"><br><br>

    <label for="amenities">Amenities:</label><br>
    <input type="checkbox" name="amenities[]" id="air_conditioning" value="air_conditioning"> Air Conditioning<br>
    <input type="checkbox" name="amenities[]" id="ashtray" value="ashtray"> Ashtray<br><br>

    <input type="submit" name="submit" value="Reserve">
</form>

<?php
if(isset($_POST['submit'])) {
    $num_of_guests = $_POST['num_of_guests'];
    echo "<h3>Guest Information:</h3>";
    for($i = 1; $i <= $num_of_guests; $i++) {
        echo "<p>Guest $i:</p>";
        echo "Name: " . $_POST['name_'.$i] . "<br>";
        echo "Email: " . $_POST['email_'.$i] . "<br>";
    }

    echo "<h3>Reservation Details:</h3>";
    echo "Credit Card Information: " . $_POST['credit_card'] . "<br>";
    echo "Arrival Date: " . $_POST['arrival_date'] . "<br>";
    echo "Departure Date: " . $_POST['departure_date'] . "<br>";
    echo "Arrival Time: " . $_POST['arrival_time'] . "<br>";
    echo "Child Bed: " . (isset($_POST['child_bed']) ? 'Yes' : 'No') . "<br>";
    echo "Amenities: " . (isset($_POST['amenities']) ? implode(", ", $_POST['amenities']) : 'None') . "<br>";
}
?>

</body>
</html>
