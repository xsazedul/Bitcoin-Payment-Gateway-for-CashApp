-- Database Schema

DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS invoices;
DROP TABLE IF EXISTS admins;


CREATE TABLE IF NOT EXISTS invoices (
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
);

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id VARCHAR(255) NOT NULL,
    transaction_id VARCHAR(255) UNIQUE,
    amount_paid BIGINT NOT NULL,
    payment_method VARCHAR(50) DEFAULT 'lightning',
    paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (invoice_id) REFERENCES invoices(invoice_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin user (password: admin123)
INSERT IGNORE INTO admins (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
