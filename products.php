<?php
// products.php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Hampers - Bliss Bite</title>
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
        <h1 class="section-title" style="margin-top: 3rem;">Shop All Hampers</h1>
        
        <div class="grid grid-4">
            <?php foreach($products as $p): ?>
                <div class="card reveal active">
                    <div class="card-img-container">
                        <img src="<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" class="card-img">
                        <div class="card-overlay">
                            <a href="product.php?id=<?php echo $p['id']; ?>" class="btn btn-primary" style="font-size:1rem; padding: 0.8rem 2rem;">Order Now</a>
                        </div>
                    </div>
                    <div class="card-body" style="text-align: center;">
                        <h3 class="card-title" style="font-size: 1.1rem;"><?php echo htmlspecialchars($p['name']); ?></h3>
                        <div class="card-price" style="margin-bottom: 0;">₹<?php echo htmlspecialchars($p['price']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if(empty($products)): ?>
                <p>No products available right now. Please check back later!</p>
            <?php endif; ?>
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
