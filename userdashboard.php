<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
        <div class="dashboard-grid">
            <!-- User Profile Section -->
            <div class="user-profile">
                <img src="https://via.placeholder.com/150" alt="User Profile" class="profile-img">
                <h3>King Arthur</h3>
                <p>Email: king.arthur@example.com</p>
            </div>

            <!-- Appointment Section -->
            <div class="appointment">
                <h2>Next Appointment</h2>
                <p>Date: December 12, 2024</p>
                <p>Time: 2:00 PM</p>
                <p>Location: Conference Room A</p>
            </div>
        </div>

        <!-- Current Reservations Section -->
        <div class="reservations">
            <h2>Current Reservations</h2>
            <ul>
                <li>Reservation #1: Conference Room B - December 15, 2024</li>
                <li>Reservation #2: Meeting Room C - December 20, 2024</li>
                <li>Reservation #3: Auditorium - January 10, 2025</li>
            </ul>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
</body>
</html>
