<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wynik</title>
</head>
<body>
<h1>Wynik działania</h1>
<?php
// Pobranie danych z formularza
$liczba1 = $_POST['liczba1'];
$liczba2 = $_POST['liczba2'];
$dzialanie = $_POST['dzialanie'];

// Obsługa wybranego działania
switch ($dzialanie) {
    case 'dodawanie':
        $wynik = $liczba1 + $liczba2;
        echo "Wynik dodawania: $wynik";
        break;
    case 'odejmowanie':
        $wynik = $liczba1 - $liczba2;
        echo "Wynik odejmowania: $wynik";
        break;
    case 'mnozenie':
        $wynik = $liczba1 * $liczba2;
        echo "Wynik mnożenia: $wynik";
        break;
    case 'dzielenie':
        if ($liczba2 != 0) {
            $wynik = $liczba1 / $liczba2;
            echo "Wynik dzielenia: $wynik";
        } else {
            echo "Nie można dzielić przez zero!";
        }
        break;
    default:
        echo "Nieprawidłowe działanie";
}
?>
</body>
</html>
