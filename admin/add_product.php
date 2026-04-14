<?php
// admin/add_product.php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

require_once '../config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $description = $_POST['description'] ?? '';
    
    // Default image if failed
    $imagePath = 'https://images.unsplash.com/photo-1549465220-1a8b9238cd48?auto=format&fit=crop&w=600&q=80';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = 'uploads/' . $fileName; // path relative to root
        } else {
            $message = "Failed to upload image.";
        }
    } else {
        // If they provided a URL instead
        if(!empty($_POST['image_url'])) {
            $imagePath = $_POST['image_url'];
        }
    }

    if (empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $price, $description, $imagePath])) {
            $message = "Product added successfully!";
        } else {
            $message = "Error adding product.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - Bliss Bite Admin</title>
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

    <div class="admin-container">
        <h2>Add New Product</h2>
        <?php if($message): ?><p style="color:green; margin-bottom:1rem;"><?php echo htmlspecialchars($message); ?></p><?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Price (₹)</label>
                <input type="number" name="price" class="form-control" min="1" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label>Upload Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small style="color:var(--text-light); margin-top:0.5rem; display:block;">Or provide an image URL below:</small>
            </div>
             <div class="form-group">
                <input type="url" name="image_url" class="form-control" placeholder="https://unsplash.com/...">
            </div>
            <button type="submit" class="btn btn-primary">Save Product</button>
        </form>
    </div>
</body>
</html>
