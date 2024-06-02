<?php
$host = 'localhost';
$db = 'carsDB';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS cars (
        id INT AUTO_INCREMENT PRIMARY KEY,
        brand VARCHAR(255) NOT NULL,
        model VARCHAR(255) NOT NULL,
        price FLOAT NOT NULL,
        year INT NOT NULL,
        description TEXT
    )";
    $pdo->exec($sql);

    echo "Table cars created successfully";
} catch (PDOException $e) {
    die("Error while connecting to the database: " . $e->getMessage());
}
?>