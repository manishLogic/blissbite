-- Bliss Bite Setup Script
-- Create Database
CREATE DATABASE IF NOT EXISTS bliss_bite;
USE bliss_bite;

-- Create Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    description TEXT,
    image VARCHAR(255)
);

-- Create Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    product_id INT NOT NULL,
    message TEXT,
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Insert Sample Products
INSERT INTO products (name, price, description, image) VALUES
('Luxury Spa Retreat', 85, 'A relaxing spa hamper with bath salts, essential oils, soft towels, and scented candles.', 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=600&q=80'),
('Gourmet Chocolate Box', 45, 'Indulge in our exquisite collection of dark, milk, and white artisanal chocolates.', 'https://images.unsplash.com/photo-1544453835-f0ea9fb7133f?auto=format&fit=crop&w=600&q=80'),
('Romantic Anniversary Mix', 120, 'Premium red wine, assorted truffles, a fresh rose, and luxury treats for a romantic evening.', 'https://images.unsplash.com/photo-1525268771113-32d9e9021a97?auto=format&fit=crop&w=600&q=80');
