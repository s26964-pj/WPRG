<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odwracanie Wierszy w Pliku Tekstowym</title>
</head>
<body>
<h1>Odwracanie Wierszy w Pliku Tekstowym</h1>
<form action="Zad1.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".txt"><br><br>
    <input type="submit" value="Odwróć wiersze" name="submit">
</form>

<?php
if (isset($_FILES['fileToUpload'])) {
    $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
    $fileName = $_FILES['fileToUpload']['name'];
    $fileSize = $_FILES['fileToUpload']['size'];
    $fileType = $_FILES['fileToUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedfileExtensions = array('txt');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        $fileContent = file_get_contents($fileTmpPath);
        $lines = explode(PHP_EOL, $fileContent);
        $reversedLines = array_reverse($lines);
        $reversedContent = implode(PHP_EOL, $reversedLines);

        echo "<h2>Odwrócony plik:</h2>";
        echo "<pre>$reversedContent</pre>";
    } else {
        echo "Błędny typ pliku. Proszę przesłać plik tekstowy (.txt).";
    }
}
?>
</body>
</html>
