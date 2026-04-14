# Bliss Bite - Manual Instructions & Setup Guide

Welcome to the **Bliss Bite** platform. Below are the complete manual instructions required to set up, run, and manage this E-Commerce web application from scratch.

---

## 1. Prerequisites
Before running the application, ensure you have the following installed on your system:
- **XAMPP Environment** (Provides Apache Web Server & MySQL Database).
- **Web Browser** (Google Chrome, Firefox, or Safari).

## 2. Installation & Server Setup
1. **Start XAMPP**: Open the XAMPP Control Panel and click the **Start** button for both the **Apache** and **MySQL** modules.
2. **Locate `htdocs`**: Navigate to `C:\xampp\htdocs\`.
3. **Copy Files**: Ensure the entire Bliss Bite project folder is placed inside `htdocs` and is named `bliss_bite`. The directory structure should look like `C:\xampp\htdocs\bliss_bite\...`.

## 3. Database Configuration
1. **Open phpMyAdmin**: Open your browser and go to `http://localhost/phpmyadmin`.
2. **Create Database**: Click "New" on the left sidebar and create a new database named `bliss_bite`.
3. **Import Tables**: 
   - Click on the `bliss_bite` database you just created.
   - Go to the **Import** tab at the top.
   - Choose the `setup.sql` file located in your project folder.
   - Click **Import** at the bottom of the page to build the required `products` and `orders` tables.

## 4. Running the Application
Once the database is set up, you can execute the website locally:
- **Customer Frontend**: Open your browser and navigate to `http://localhost/bliss_bite/index.html`.
- **Shop Directory**: View all dynamically loaded products at `http://localhost/bliss_bite/products.php`.

## 5. Automated Image Importer (Backend Setup)
Instead of manually typing SQL commands to add products, this project includes an automated image scanner!
1. **Add Images**: Add your physical `.jpg`, `.png`, or `.jpeg` images into the `C:\xampp\htdocs\bliss_bite\images\` directory.
2. **Run the Script**: Open your browser and go to `http://localhost/bliss_bite/import_images.php`.
3. **Result**: The script will dynamically read every image, register it as a "Custom Bliss Hamper", assign it a randomized Rupee pricing, and inject it securely into the database so it appears on the live website automatically.

## 6. Accessing the Admin Panel
You can manually view and manage products and customer orders utilizing the shielded Admin Panel.
- **Manage Inventory**: `http://localhost/bliss_bite/admin/manage_products.php`
- **View Orders**: `http://localhost/bliss_bite/admin/orders.php`
*(Note: If you encounter an authentication block, check `admin/login.php` credentials or modify `admin/orders.php` to bypass dev-mode).*

## 7. Troubleshooting
- **Website looks broken or stretching**: Ensure you are using `http://localhost/bliss_bite/...` in your browser. Opening the `index.html` file directly by double-clicking it via `file:///C:/...` will break PHP functionality and relative paths.
- **Database Connection Error**: Ensure MySQL is running in XAMPP, and verify that the `config.php` file has the correct database name (`bliss_bite`) and root credentials (usually `root` and an empty password).
