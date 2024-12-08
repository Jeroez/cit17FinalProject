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
        $_SESSION['error'] = 'Email and password are required.';
        header('Location: login.php');
        exit();
    }

    try {
        $query = $pdo->prepare("
            SELECT user_id, full_name, email, password, created_at, role
            FROM users
            WHERE email = :email
            LIMIT 1
        ");
        $query->bindParam(':email', $email);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die('User not found for email: ' . htmlspecialchars($email));
        }

        if (!password_verify($password, $user['password'])) {
            die('Password does not match for email: ' . htmlspecialchars($email));
        }

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['created_at'] = $user['created_at'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: admindashboard.php');
        } else {
            header('Location: dashboard.php');
        }
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'An error occurred. Please try again.';
        header('Location: login.php');
        exit();
    }
}
