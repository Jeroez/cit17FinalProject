<?php
include 'db.php';
include 'header.php';

if (isset($_GET['class_id'])) {
    $classId = (int)$_GET['class_id'];
    $query = $pdo->prepare("SELECT * FROM classes WHERE class_id = :class_id");
    $query->bindParam(':class_id', $classId);
    $query->execute();
    $class = $query->fetch(PDO::FETCH_ASSOC);

    if (!$class) {
        die("Class not found!");
    }
}
?>
<main>
    <h2>Book Your Class</h2>
    <form method="POST" action="confirm_booking.php">
        <h3><?= htmlspecialchars($class['class_name']) ?></h3>
        <p><?= htmlspecialchars($class['description']) ?></p>
        <p><strong>Price:</strong> $<?= number_format($class['price'], 2) ?></p>
        <p><strong>Skill Level:</strong> <?= ucfirst(htmlspecialchars($class['skill_level'])) ?></p>
        <input type="hidden" name="class_id" value="<?= $class['class_id'] ?>">
        <label for="booking_date">Select Date:</label>
        <input type="date" name="booking_date" required>
        <button type="submit">Confirm Booking</button>
    </form>
</main>
<?php include 'footer.php'; ?>
