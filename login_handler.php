<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $csrfToken = $_POST['csrf_token'] ?? '';

    if (empty($csrfToken) || $csrfToken !== ($_SESSION['csrf_token'] ?? '')) {
        die('Invalid CSRF token.');
    }

    if (empty($email) || empty($password)) {
        die('Email and Password are required.');
    }

    $query = $pdo->prepare("SELECT user_id, email, password FROM users WHERE email = :email LIMIT 1");
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['email'] === 'admin@example.com') { 
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = true; 
            header('Location: admindashboard.php');
            exit();
        }

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['is_admin'] = false;
        header('Location: dashboard.php');
        exit();
    } else {
        die('Invalid email or password.');
    }
} else {
    die('Invalid request method.');
}