<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Podsumowanie rezerwacji</title>
</head>
<body>
<h1>Podsumowanie rezerwacji</h1>
<?php
// Pobranie danych z formularza
$ilosc_osob = $_POST['ilosc_osob'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$adres = $_POST['adres'];
$email = $_POST['email'];
$data_pobytu = $_POST['data_pobytu'];
$godzina_przyjazdu = $_POST['godzina_przyjazdu'];
$dostawienie_lozka = isset($_POST['dostawienie_lozka']) ? "Tak" : "Nie";
$udogodnienia = isset($_POST['udogodnienia']) ? implode(', ', $_POST['udogodnienia']) : "Brak";

// Wyświetlenie podsumowania rezerwacji
echo "<p>Ilość osób: $ilosc_osob</p>";
echo "<p>Imię: $imie</p>";
echo "<p>Nazwisko: $nazwisko</p>";
echo "<p>Adres: $adres</p>";
echo "<p>Email: $email</p>";
echo "<p>Data pobytu: $data_pobytu</p>";
echo "<p>Godzina przyjazdu: $godzina_przyjazdu</p>";
echo "<p>Czy jest potrzeba dostawienia łóżka dla dziecka? $dostawienie_lozka</p>";
echo "<p>Udogodnienia: $udogodnienia</p>";
?>
</body>
</html>
