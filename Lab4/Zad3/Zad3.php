<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista odnośników</title>
</head>
<body>
<h1>Lista odnośników</h1>
<ul>
    <?php
    $file = 'linki.txt';

    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            list($url, $description) = explode(';', $line);
            echo '<li><a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($description) . '</a></li>';
        }
    } else {
        echo '<p>Plik z linkami nie istnieje.</p>';
    }
    ?>
</ul>
</body>
</html>