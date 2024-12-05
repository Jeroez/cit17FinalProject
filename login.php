<?php
session_start();
include 'db.php';
include 'header.php';

// Generate CSRF Token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Display any error messages
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']); // Clear the error message after displaying
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <section class="hero">
            <h1>Welcome Back!</h1>
            <p>Please log in to access your account.</p>
        </section>

        <form method="POST" action="login_handler.php">
            <h2>Login</h2>
            <?php if ($error): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <button type="submit">Log In</button>
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </form>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>