<?php
// product.php
require_once 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header("Location: products.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die("Product not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Bliss Bite</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header>
        <div class="nav-container reveal active">
            <a href="index.html" class="logo">BlissBite.</a>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="products.php" class="active">Shop Collection</a></li>
            </ul>
        </div>
    </header>

    <main class="container" style="min-height: 70vh;">
        <div class="product-detail">
            <div class="product-detail-img">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="product-detail-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="price">₹<?php echo htmlspecialchars($product['price']); ?></div>
                <p style="font-size: 1.1rem; margin-bottom: 2rem; color: var(--text-light);"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                
                <a href="order.php?id=<?php echo $product['id']; ?>" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem;">Order Now</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>BlissBite.</h3>
                <p style="max-width: 300px; line-height: 1.8;">Premium curated gift hampers designed to impress. Elevating the art of gifting since 2026.</p>
                <div class="social-icons">
                    <a href="https://www.instagram.com/bliss_bite01/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="products.php">Shop Hampers</a></li>
                </ul>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem; text-align: center; font-size: 0.9rem;">
            &copy; 2026 Bliss Bite. All rights reserved.
        </div>
    </footer>
</body>
</html>
