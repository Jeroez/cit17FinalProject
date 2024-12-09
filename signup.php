<?php
include 'db.php';
include 'header.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $role = 'user';

    if (strlen($full_name) < 3) {
        $error = "Full Name must be at least 3 characters long.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
     
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            
            $query = $pdo->prepare("INSERT INTO users (full_name, email, password, role) VALUES (:full_name, :email, :password, :role)");
            $query->bindParam(':full_name', $full_name);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $hashedPassword); // Use the hashed password here
            $query->bindParam(':role', $role);
            $query->execute();

            $user_id = $pdo->lastInsertId();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $full_name;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            header("Location:dashboard.php");
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { 
                $error = "This email is already registered.";
            } else {
                $error = "An error occurred. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="hero">
        <h1>Create an Account</h1>
        <p>Join us today and enjoy exclusive benefits.</p>
    </section>

    <form method="POST" action="">
        <h2>Sign Up</h2>
        <?php
        if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>

        <button type="submit">Sign Up</button>

        <p>Already have an account? <a href="login.php">Log In</a></p>
    </form>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
