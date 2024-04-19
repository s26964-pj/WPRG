<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynik sprawdzenia liczby pierwszej</title>
</head>
<body>
<h2>Wynik sprawdzenia liczby pierwszej</h2>
<?php
function is_prime($number) {
    if ($number <= 1) {
        return false;
    }
    if ($number <= 3) {
        return true;
    }
    if ($number % 2 == 0 || $number % 3 == 0) {
        return false;
    }
    $i = 5;
    while ($i * $i <= $number) {
        if ($number % $i == 0 || $number % ($i + 2) == 0) {
            return false;
        }
        $i += 6;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['number']) && is_numeric($_POST['number'])) {
        $number = intval($_POST['number']);
        if ($number > 0) {
            $iterations = 0;
            $is_prime = is_prime($number);
            if ($is_prime) {
                echo "$number jest liczbą pierwszą.";
            } else {
                echo "$number nie jest liczbą pierwszą.";
            }
        } else {
            echo "Podana wartość nie jest liczbą całkowitą dodatnią.";
        }
    } else {
        echo "Podana wartość nie jest liczbą.";
    }
}
?>
</body>
</html>
