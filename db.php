<?php
$host = 'localhost';
$dbname = 'anime_art_booking';
$username = 'root';
$password = ''; // Leave empty for XAMPP default


try {
    $pdo = new PDO('mysql:host=localhost;dbname=anime_art_booking', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>

