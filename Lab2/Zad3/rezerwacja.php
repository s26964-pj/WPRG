<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie rezerwacji</title>
</head>
<body>
<h2>Podsumowanie rezerwacji</h2>
<?php
$guests = $_POST['guests'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$address = $_POST['address'];
$credit_card = $_POST['credit_card'];
$email = $_POST['email'];
$stay_date = $_POST['stay_date'];
$arrival_time = $_POST['arrival_time'];
$extra_bed = isset($_POST['extra_bed']) ? 'Tak' : 'Nie';
$amenities = isset($_POST['amenities']) ? implode(', ', $_POST['amenities']) : 'Brak';

echo "<p>Liczba osób: $guests</p>";
echo "<p>Imię: $name</p>";
echo "<p>Nazwisko: $surname</p>";
echo "<p>Adres: $address</p>";
echo "<p>Dane karty kredytowej: $credit_card</p>";
echo "<p>E-mail: $email</p>";
echo "<p>Data pobytu: $stay_date</p>";
echo "<p>Godzina przyjazdu: $arrival_time</p>";
echo "<p>Potrzeba dostawienia łóżka dla dziecka: $extra_bed</p>";
echo "<p>Udogodnienia: $amenities</p>";

// Formularz dla danych osób
if ($guests > 1) {
    echo "<h3>Dane pozostałych osób:</h3>";
    echo "<form action='rezerwacja.php' method='POST'>";
    for ($i = 2; $i <= $guests; $i++) {
        echo "<h4>Osoba $i</h4>";
        echo "<label for='guest_name_$i'>Imię:</label>";
        echo "<input type='text' name='guest_name_$i' id='guest_name_$i' required>";
        echo "<br><br>";
        echo "<label for='guest_surname_$i'>Nazwisko:</label>";
        echo "<input type='text' name='guest_surname_$i' id='guest_surname_$i' required>";
        echo "<br><br>";
    }
    echo "<input type='submit' value='Dodaj'>";
    echo "</form>";
}
?>
</body>
</html>
