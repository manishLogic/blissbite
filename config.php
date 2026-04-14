<?php
// config.php
$host = 'localhost';
$dbname = 'bliss_bite';
$username = 'root'; // default XAMPP/WAMP user
$password = ''; // default XAMPP/WAMP password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to Associative Array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . ". Please ensure you have created the 'bliss_bite' database via setup.sql and the credentials are correct.");
}
?>
