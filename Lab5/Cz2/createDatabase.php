<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS carsDB";
    $pdo->exec($sql);

    echo "Database carsDB created successfully";
} catch (PDOException $e) {
    die("Error while connecting to the database: " . $e->getMessage());
}
?>