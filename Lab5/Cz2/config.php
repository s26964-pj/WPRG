<?php
$host = 'localhost';
$db = 'carsDB';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error while connecting to the database: " . $e->getMessage());
}

$GLOBALS['pdo'] = $pdo;
?>