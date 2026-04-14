<?php
// admin/orders.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

require_once '../config.php';

// Fetch orders with product details
$sql = "
    SELECT o.*, p.name as product_name, p.price as product_price 
    FROM orders o 
    JOIN products p ON o.product_id = p.id 
    ORDER BY o.created_at DESC
";
$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders - Bliss Bite Admin</title>
    <link rel="stylesheet" href="../css/style.css">
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

    <div class="admin-container" style="max-width: 1100px;">
        <h2>Order List</h2>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Product</th>
                        <th>Message</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $o): ?>
                        <tr>
                            <td>#<?php echo $o['id']; ?></td>
                            <td><?php echo date('M d, Y H:i', strtotime($o['created_at'])); ?></td>
                            <td><?php echo htmlspecialchars($o['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($o['phone']); ?></td>
                            <td><?php echo htmlspecialchars($o['address']); ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($o['product_name']); ?></strong><br>
                                ₹<?php echo htmlspecialchars($o['product_price']); ?>
                            </td>
                            <td><i><?php echo htmlspecialchars($o['message'] ?: 'N/A'); ?></i></td>
                            <td><span style="background:var(--secondary-color); padding:0.2rem 0.5rem; border-radius:4px; font-size:0.9em;"><?php echo htmlspecialchars($o['status']); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if(empty($orders)): ?>
                        <tr><td colspan="8" style="text-align:center;">No orders found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
