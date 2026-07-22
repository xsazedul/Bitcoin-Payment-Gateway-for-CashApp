<?php
// Simple Installation Script to auto-import the database

require __DIR__ . '/app/Core/Config.php';
require __DIR__ . '/app/Core/Database.php';

use App\Core\Config;
use App\Core\Database;

// Load environment variables
Config::load(__DIR__ . '/.env');

try {
    // Get DB connection
    $db = Database::getInstance();
    
    // Read the schema.sql file
    $sql = file_get_contents(__DIR__ . '/schema.sql');
    
    if (!$sql) {
        throw new Exception("Could not read schema.sql file. Make sure it exists in the same directory.");
    }

    // Split the SQL file into individual statements
    $statements = explode(';', $sql);
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            $db->exec($statement);
        }
    }
    echo "<div style='font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>";
    echo "<h2 style='color: #00C244;'>✅ Database tables created successfully!</h2>";
    echo "<p>The invoices, payments, and admin tables have been imported into your database.</p>";
    echo "<a href='/' style='display: inline-block; padding: 10px 20px; background: #00C244; color: white; text-decoration: none; border-radius: 8px;'>Go to Homepage</a>";
    echo "<p style='margin-top: 30px; color: #ff3b30; font-size: 14px;'>⚠️ <b>IMPORTANT:</b> Please delete this <b>install.php</b> file from your server after clicking the button above for security reasons!</p>";
    echo "</div>";

} catch (Exception $e) {
    echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";
    echo "<h2 style='color: #ff3b30;'>❌ Installation Failed</h2>";
    echo "<p>Error details: <b>" . htmlspecialchars($e->getMessage()) . "</b></p>";
    echo "<p>Please ensure your database credentials in the <code>.env</code> file are correct.</p>";
    echo "</div>";
}
