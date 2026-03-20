<?php
$host   = 'localhost';
$user   = 'root';
$pass   = '';       // No password (confirmed from my.ini)
$dbname = 'futurebooks_fixed'; // Your database name
$port   = 3307;     // Your custom MySQL port (from my.ini)

// Create connection (port 3307 as set in your XAMPP my.ini)
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    // Show a friendly message instead of a raw PHP error
    die("
        <div style='font-family:sans-serif; background:#1a1a2e; color:white; padding:40px; text-align:center; min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center;'>
            <h2>⚠️ Database Connection Failed</h2>
            <p style='color:#aaa;'>Could not connect to the <strong>futurebooks_fixed</strong> database.</p>
            <p style='color:#aaa;'>Please make sure:</p>
            <ul style='text-align:left; color:#ccc; line-height:2;'>
                <li>✅ XAMPP is running (Apache + MySQL both green)</li>
                <li>✅ You have created a database named <code>futurebooks_fixed</code> in phpMyAdmin</li>
                <li>✅ You have run the <code>future_books_setup.sql</code> script in phpMyAdmin</li>
                <li>⚠️ If you see \"Access denied\" — open <code>includes/db.php</code> and set your MySQL password on the <code>$pass</code> line</li>
            </ul>
            <p style='color:#e74c3c; font-size:0.85rem;'>Error: " . htmlspecialchars($conn->connect_error) . "</p>
        </div>
    ");
}

// Set charset to support UTF-8 and special characters (e.g. Sinhala)
$conn->set_charset('utf8mb4');
?>
