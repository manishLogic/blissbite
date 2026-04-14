<?php
// admin/dashboard.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

require_once '../config.php';

// Get total products
$stmt = $pdo->query("SELECT COUNT(*) FROM products");
$totalProducts = $stmt->fetchColumn();

// Get total orders
$stmt = $pdo->query("SELECT COUNT(*) FROM orders");
$totalOrders = $stmt->fetchColumn();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Bliss Bite</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .dashboard-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 2rem; }
        .stat-card { background: var(--secondary-color); padding: 2rem; border-radius: 12px; text-align: center; }
        .stat-card h3 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .stat-card p { font-size: 2.5rem; font-weight: 700; color: var(--primary-color); }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <a href="dashboard.php" class="logo">Admin Panel</a>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="add_product.php">Add Product</a></li>
                <li><a href="manage_products.php">Manage Products</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <div class="admin-container">
        <h2>Dashboard Overview</h2>
        <div class="dashboard-grid">
            <div class="stat-card">
                <h3>Total Products</h3>
                <p><?php echo htmlspecialchars($totalProducts); ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p><?php echo htmlspecialchars($totalOrders); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
