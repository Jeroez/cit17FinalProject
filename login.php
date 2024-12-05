<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = MD5(:password)");
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: admindashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        echo "Invalid credentials!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome Back!</h1>
        <p>Please log in to access your account.</p>
    </section>

    <!-- Login Form -->
    <form method="POST" action="">
        <h2>Login</h2>
        <?php
        if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Log In</button>

        <p><a href="#">Forgot Password?</a></p>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </form>

    <!-- Footer -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
