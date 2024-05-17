<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licznik Odwiedzin</title>
</head>
<body>
<?php
$file = 'licznik.txt';

if (!file_exists($file)) {
    file_put_contents($file, '1');
    $visits = 1;
} else {
    $visits = file_get_contents($file);
    $visits = intval($visits) + 1;
    file_put_contents($file, strval($visits));
}

echo "<h1>Liczba odwiedzin: " . $visits . "</h1>";
?>
</body>
</html>