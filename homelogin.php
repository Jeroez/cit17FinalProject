<?php
include 'db.php';
include 'headerlogin.php';
$query = $pdo->prepare("SELECT * FROM classes ORDER BY RAND() LIMIT 6");
$query->execute();
$featuredClasses = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
    <section class="hero">
        <h1>Welcome to Anime Art Classes</h1>
        <p>Your journey into manga and anime artistry begins here.</p>
        <a href="classes.php" class="btn">Discover Classes</a>
    </section>

    <section class="featured-classes">
        <h2>Featured Classes</h2>
        <div class="class-grid">
            <?php foreach ($featuredClasses as $class): ?>
                <div class="class-card">
                    <h3><?= htmlspecialchars($class['class_name']) ?></h3>
                    <p><?= htmlspecialchars($class['description']) ?></p>
                    <p><strong>$<?= number_format($class['price'], 2) ?></strong></p>
                    <a href="booking.php?class_id=<?= $class['class_id'] ?>" class="btn">Book Now</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
