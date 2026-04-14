<?php
// api/get_featured_products.php
require_once '../config.php';

header('Content-Type: application/json');

try {
    // Get up to 4 featured products (we'll just take the latest 3 for now)
    $stmt = $pdo->query("SELECT id, name, price, image FROM products ORDER BY id DESC LIMIT 3");
    $products = $stmt->fetchAll();
    echo json_encode($products);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Could not fetch products.']);
}
?>
