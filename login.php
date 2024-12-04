<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome Back!</h1>
        <p>Please log in to access your account.</p>
    </section>

    <!-- Login Form -->
    <form>
        <h2>Login</h2>
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Log In</button>

        <p><a href="#">Forgot Password?</a></p>
        <p>Don't have an account? <a href="#">Sign Up</a></p>
    </form>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
</body>
</html>
