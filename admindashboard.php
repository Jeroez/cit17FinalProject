<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav>
            <a href="#">Home</a>
            <a href="#">Dashboard</a>
            <a href="#">Settings</a>
            <a href="#" style="color: #f9d342;">Logout</a>
        </nav>
    </header>

    <!-- Dashboard Main Content -->
    <section class="dashboard">
        <div class="admin-grid">
            <!-- User List -->
            <div class="user-list">
                <h2>Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Replace with dynamic PHP or JS data -->
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane.smith@example.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Promotions -->
            <div class="promotions">
                <h2>Promotions</h2>
                <form>
                    <label for="promotion">Add Promotion</label>
                    <input type="text" id="promotion" name="promotion" placeholder="Enter promotion details" required>
                    <button type="submit">Add</button>
                </form>
                <h3>Current Promotions</h3>
                <ul>
                    <li>50% off on Room A</li>
                    <li>Buy 1 Get 1 Free - Meeting Room B</li>
                </ul>
            </div>

            <!-- Current Reservations -->
            <div class="reservations">
                <h2>Current Reservations</h2>
                <ul>
                    <!-- Replace with dynamic PHP or JS data -->
                    <li>John Doe: Conference Room A - December 15, 2024</li>
                    <li>Jane Smith: Auditorium - January 10, 2025</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Admin Panel. All rights reserved.</p>
    </footer>
</body>
</html>
