<?php
session_start();
include 'db.php';
include 'header.php';

// Generate CSRF Token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<main>
    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome Back!</h1>
        <p>Please log in to access your account.</p>
    </section>

    <!-- Login Form -->
    <form method="POST" action="login_handler.php">
        <h2>Login</h2>
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <button type="submit">Log In</button>

        <p><a href="forgot_password.php">Forgot Password?</a></p>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </form>
</main>

<?php include 'footer.php'; ?>