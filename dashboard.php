<?php
include 'db.php';
include 'headerlogin.php';
session_start();

$userId = 1;

$userQuery = $pdo->prepare("SELECT full_name, email FROM users WHERE user_id = :user_id");
$userQuery->bindParam(':user_id', $userId);
$userQuery->execute();
$user = $userQuery->fetch(PDO::FETCH_ASSOC);


$bookingsQuery = $pdo->prepare("
    SELECT b.booking_date, c.class_name, c.description
    FROM bookings b
    JOIN classes c ON b.class_id = c.class_id
    WHERE b.user_id = :user_id
    ORDER BY b.booking_date
");
$bookingsQuery->bindParam(':user_id', $userId);
$bookingsQuery->execute();
$bookings = $bookingsQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <section class="dashboard">
        <div class="dashboard-grid">
            <div class="user-profile">
                <img src="https://via.placeholder.com/150" alt="User Profile" class="profile-img">
                <h3><?= htmlspecialchars($user['full_name']) ?></h3>
                <p>Email: <?= htmlspecialchars($user['email']) ?></p>
            </div>

            <div class="reservations">
                <h2>Your Reservations</h2>
                <ul>
                    <?php foreach ($bookings as $booking): ?>
                        <li>
                            <strong><?= htmlspecialchars($booking['class_name']) ?></strong><br>
                            <?= htmlspecialchars($booking['description']) ?><br>
                            <em>Date: <?= htmlspecialchars($booking['booking_date']) ?></em>
                        </li>
                    <?php endforeach; ?>
                    <?php if (empty($bookings)): ?>
                        <li>No reservations found.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
