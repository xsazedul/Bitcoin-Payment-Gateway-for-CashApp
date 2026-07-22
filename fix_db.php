<?php
require __DIR__ . '/app/Core/Config.php';
require __DIR__ . '/app/Core/Database.php';

use App\Core\Config;
use App\Core\Database;

Config::load(__DIR__ . '/.env');

try {
    $db = Database::getInstance();

    // Drop old tables
    $db->exec("DROP TABLE IF EXISTS payments");
    $db->exec("DROP TABLE IF EXISTS invoices");
    $db->exec("DROP TABLE IF EXISTS admins");

    // Create invoices table
    $db->exec("CREATE TABLE invoices (
        id INT AUTO_INCREMENT PRIMARY KEY,
        invoice_id VARCHAR(255) UNIQUE NOT NULL,
        amount_usd DECIMAL(10, 2) NOT NULL,
        amount_sats BIGINT NOT NULL,
        payment_url TEXT NOT NULL,
        status ENUM('waiting', 'confirming', 'finished', 'failed', 'refunded', 'expired') DEFAULT 'waiting',
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        expires_at TIMESTAMP NULL
    )");

    // Create payments table
    $db->exec("CREATE TABLE payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        invoice_id VARCHAR(255) NOT NULL,
        transaction_id VARCHAR(255) UNIQUE,
        amount_paid DECIMAL(10, 8) NOT NULL,
        payment_method VARCHAR(50) DEFAULT 'crypto',
        paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (invoice_id) REFERENCES invoices(invoice_id) ON DELETE CASCADE
    )");

    // Create admins table
    $db->exec("CREATE TABLE admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Insert admin
    $db->exec("INSERT IGNORE INTO admins (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')");

    echo "<h1 style='color: green;'>DATABASE FIXED SUCCESSFULLY!</h1>";
    echo "<p>All tables have been forcefully dropped and recreated with the correct NowPayments columns.</p>";
    echo "<a href='/'>Go to homepage and test again</a>";

} catch (Exception $e) {
    echo "<h1 style='color: red;'>ERROR</h1>";
    echo $e->getMessage();
}
