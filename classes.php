<?php
include 'db.php';
include 'header.php';

$filterQuery = "SELECT * FROM classes";
$conditions = [];

if (!empty($_GET['skill_level'])) {
    $conditions[] = "skill_level = :skill_level";
}

if (!empty($conditions)) {
    $filterQuery .= " WHERE " . implode(' AND ', $conditions);
}

$query = $pdo->prepare($filterQuery);
if (!empty($_GET['skill_level'])) {
    $query->bindParam(':skill_level', $_GET['skill_level']);
}
$query->execute();
$classes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<main>
    <aside>
        <form method="GET" action="classes.php">
            <h4>Filter by:</h4>
            <label>Skill Level</label>
            <select name="skill_level">
                <option value="">All</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <button type="submit">Apply Filters</button>
        </form>
    </aside>

    <section class="class-list">
        <h2>Available Classes</h2>
        <div class="class-grid">
            <?php foreach ($classes as $class): ?>
                <div class="class-card">
                    <h3><?= htmlspecialchars($class['class_name']) ?></h3>
                    <p><?= htmlspecialchars($class['description']) ?></p>
                    <p>Skill Level: <?= ucfirst($class['skill_level']) ?></p>
                    <p><strong>$<?= number_format($class['price'], 2) ?></strong></p>
                    <a href="booking.php?class_id=<?= $class['class_id'] ?>" class="btn">Book Now</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
