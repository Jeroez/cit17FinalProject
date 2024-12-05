<?php
include 'db.php';
include 'headerlogin.php';
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$classCount = $pdo->query("SELECT COUNT(*) FROM classes")->fetchColumn();
$bookingCount = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
$users = $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <section class="admin-dashboard">
        <h2>Admin Dashboard</h2>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p><?= $userCount ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Classes</h3>
                <p><?= $classCount ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Bookings</h3>
                <p><?= $bookingCount ?></p>
            </div>
        </div>

        <h3>Recent Users</h3>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['full_name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td><?= htmlspecialchars($user['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'footer.php'; ?>
