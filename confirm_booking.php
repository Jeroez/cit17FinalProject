<?php
session_start(); // Start the session to access user data
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $classId = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
    $bookingDate = filter_input(INPUT_POST, 'booking_date', FILTER_SANITIZE_STRING);

    // Retrieve user_id from session
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in. Please log in to book a class.");
    }
    $userId = $_SESSION['user_id'];

    if (!$classId || !$bookingDate) {
        die("Invalid input.");
    }

    // Check if the class exists
    $query = $pdo->prepare("SELECT * FROM classes WHERE class_id = :class_id");
    $query->bindParam(':class_id', $classId);
    $query->execute();
    $class = $query->fetch(PDO::FETCH_ASSOC);

    if (!$class) {
        die("Class not found.");
    }

    // Insert booking into the database
    $insertQuery = $pdo->prepare("
        INSERT INTO bookings (class_id, user_id, booking_date, created_at) 
        VALUES (:class_id, :user_id, :booking_date, NOW())
    ");
    $insertQuery->bindParam(':class_id', $classId);
    $insertQuery->bindParam(':user_id', $userId);
    $insertQuery->bindParam(':booking_date', $bookingDate);

    if ($insertQuery->execute()) {
        echo "<main>
                <h2>Booking Confirmed</h2>
                <p>Thank you for booking <strong>" . htmlspecialchars($class['class_name']) . "</strong>.</p>
                <p>Your selected date: <strong>" . htmlspecialchars($bookingDate) . "</strong></p>
              </main>";
    } else {
        echo "<main><p>Failed to confirm your booking. Please try again.</p></main>";
    }
} else {
    // Redirect to a safe page if the script is accessed directly
    header("Location: index.php");
    exit;
}

include 'footer.php';
?>
