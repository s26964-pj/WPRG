<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

try {
    $pdo = new PDO("mysql:host=$servername", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->exec("USE $dbname");

    // Create posts table
    $pdo->exec("CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Create comments table
    $pdo->exec("CREATE TABLE IF NOT EXISTS comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        post_id INT NOT NULL,
        user_id INT DEFAULT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
    )");

    // Create users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'author', 'user') NOT NULL DEFAULT 'user'
    )");

    // Create logs table
    $pdo->exec("CREATE TABLE IF NOT EXISTS logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        action VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");

    // Insert some sample data into posts table
    $pdo->exec("INSERT INTO posts (title, content) VALUES
        ('Post 1', 'Content of post 1'),
        ('Post 2', 'Content of post 2'),
        ('Post 3', 'Content of post 3')
    ");

    // Insert some sample data into users table
    $pdo->exec("INSERT INTO users (username, password, role) VALUES
        ('admin', 'admin123', 'admin'),
        ('author1', 'author123', 'author'),
        ('author2', 'author123', 'author'),
        ('user1', 'user123', 'user'),
        ('user2', 'user123', 'user')
    ");

    // Insert some sample data into comments table
    $pdo->exec("INSERT INTO comments (post_id, user_id, content) VALUES
        (1, 4, 'Comment 1 for post 1'),
        (1, 5, 'Comment 2 for post 1'),
        (2, 4, 'Comment 1 for post 2')
    ");

    echo "Database, tables, and sample data created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
