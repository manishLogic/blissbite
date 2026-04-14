<?php
// import_images.php
require_once 'config.php';

echo "<h1>Image Import and Setup Script</h1>";

$imagesDir = __DIR__ . '/images/';
$files = scandir($imagesDir);
$imageFiles = [];

foreach ($files as $file) {
    if (strpos($file, 'WhatsApp') !== false && (strpos(strtolower($file), '.jpeg') !== false || strpos(strtolower($file), '.jpg') !== false)) {
        $imageFiles[] = 'images/' . $file;
    }
}

echo "<p>Found " . count($imageFiles) . " images in the images/ folder.</p>";

if (count($imageFiles) > 0) {
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $pdo->exec("TRUNCATE TABLE products;");
    $pdo->exec("TRUNCATE TABLE orders;");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

    $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
    
    $counter = 1;
    foreach ($imageFiles as $imgPath) {
        $name = "Custom Bliss Hamper Edition " . $counter;
        $price = 45 + ($counter * 5);
        $description = "A beautiful bespoke hamper crafted with love. Perfect for any special occasion or celebration. Contains a curated selection of premium products.";
        
        $stmt->execute([$name, $price, $description, $imgPath]);
        $counter++;
    }
    
    echo "<p>Successfully imported " . ($counter-1) . " products into the database!</p>";
} else {
    echo "<p>No images found in images/ directory.</p>";
}
?>
