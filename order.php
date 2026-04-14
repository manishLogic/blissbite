<?php
// order.php
require_once 'config.php';

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;

if ($product_id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
}

$message_success = "";
$message_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = (int)($_POST['product_id'] ?? 0);
    $customer_name = trim($_POST['customer_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (!$product_id || !$customer_name || !$phone || !$address) {
        $message_error = "Please fill in all required fields.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, phone, address, product_id, message) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$customer_name, $phone, $address, $product_id, $message])) {
            $message_success = "Your order has been placed successfully! We will contact you soon.";
            $product = null; // Hide the form on success
        } else {
            $message_error = "There was an error processing your order. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order - Bliss Bite</title>
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

    <main class="container" style="min-height: 70vh; max-width: 800px; padding-top: 3rem;">
        
        <?php if($message_success): ?>
            <div style="background: #d4edda; color: #155724; padding: 2rem; border-radius: 12px; text-align: center; margin-bottom: 2rem;">
                <h2>Thank You!</h2>
                <p style="font-size: 1.2rem; margin-top: 1rem;"><?php echo htmlspecialchars($message_success); ?></p>
                <a href="index.html" class="btn btn-primary" style="margin-top: 2rem;">Return Home</a>
            </div>
        <?php else: ?>
            
            <?php if(!$product): ?>
                <div style="text-align: center; padding: 4rem 0;">
                    <h2>No product selected.</h2>
                    <a href="products.php" class="btn btn-secondary" style="margin-top: 1rem;">Go to Shop</a>
                </div>
            <?php else: ?>
                <h1 style="margin-bottom: 2rem; text-align:center;">Complete Your Order</h1>
                
                <div style="background: var(--white); padding: 2rem; border-radius: 16px; box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: 2rem; margin-bottom: 2rem;">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product" style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px;">
                    <div>
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($product['name']); ?></h3>
                        <div style="color: var(--primary-color); font-weight: bold; font-size: 1.2rem;">₹<?php echo htmlspecialchars($product['price']); ?></div>
                    </div>
                </div>

                <?php if($message_error): ?>
                    <div style="color: red; margin-bottom: 1rem; text-align: center;"><?php echo htmlspecialchars($message_error); ?></div>
                <?php endif; ?>

                <form method="POST" id="orderForm" style="background: var(--white); padding: 3rem; border-radius: 16px; box-shadow: var(--shadow-sm); margin-bottom: 4rem;">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    
                    <div class="form-group">
                        <label>Your Full Name *</label>
                        <input type="text" name="customer_name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required placeholder="(123) 456-7890">
                    </div>
                    
                    <div class="form-group">
                        <label>Delivery Address *</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Custom Message (Optional)</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Add a note to be included in the hamper..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; margin-top: 1rem;">Confirm Order - ₹<?php echo htmlspecialchars($product['price']); ?></button>
                </form>
            <?php endif; ?>
        <?php endif; ?>

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
    
    <script src="js/main.js"></script>
</body>
</html>
