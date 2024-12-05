<?php
$host = 'localhost';
$dbname = 'anime_art_booking';
$username = 'root';
$password = ''; // Leave empty for XAMPP default

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
