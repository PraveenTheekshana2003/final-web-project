<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Must be logged in to checkout
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname  = sanitize_input($_POST['fullname']);
    $address   = sanitize_input($_POST['address']);
    $contact   = sanitize_input($_POST['contact']);
    // Do NOT sanitize cart_data — it is JSON, sanitizing breaks it
    $cart_data = $_POST['cart_data'];
    $user_id   = $_SESSION['user_id'];

    // Validate cart data is valid JSON
    $decoded = json_decode($cart_data, true);
    if (!$decoded || !is_array($decoded) || count($decoded) === 0) {
        echo "<script>alert('Your cart is empty or invalid. Please add books before checking out.'); window.location.href='cart.php';</script>";
        exit();
    }

    // Validate required fields
    if (empty($fullname) || empty($address) || empty($contact)) {
        echo "<script>alert('All fields are required. Please fill in your details.'); window.location.href='cart.php';</script>";
        exit();
    }

    // Ensure the orders table exists
    $conn->query("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        fullname VARCHAR(100) NOT NULL,
        address TEXT NOT NULL,
        contact VARCHAR(50) NOT NULL,
        cart_data LONGTEXT NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    )");

    $stmt = $conn->prepare("INSERT INTO orders (user_id, fullname, address, contact, cart_data) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $fullname, $address, $contact, $cart_data);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Order Confirmed | Future Books</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="images/circular logo.png">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="style.css">
            <style>
                body {
                    font-family: 'Outfit', sans-serif;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
                }
                .success-card {
                    background: rgba(255, 255, 255, 0.1);
                    backdrop-filter: blur(20px);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    border-radius: 30px;
                    padding: 60px 50px;
                    text-align: center;
                    max-width: 550px;
                    width: 90%;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                }
                .checkmark {
                    font-size: 5rem;
                    margin-bottom: 20px;
                    display: block;
                }
                .order-id {
                    background: rgba(255,255,255,0.15);
                    border-radius: 12px;
                    padding: 10px 20px;
                    font-size: 0.9rem;
                    margin: 20px 0;
                    display: inline-block;
                }
                .btn-home {
                    background: var(--link-hover-color);
                    border: none;
                    color: white;
                    padding: 14px 40px;
                    border-radius: 50px;
                    font-weight: 700;
                    font-size: 1rem;
                    margin-top: 10px;
                    text-decoration: none;
                    display: inline-block;
                    transition: all 0.3s;
                }
                .btn-home:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
                    color: white;
                }
            </style>
        </head>
        <body>
            <div class="success-card">
                <span class="checkmark">✅</span>
                <h1 class="fw-bold mb-2">Order Placed Successfully!</h1>
                <p class="text-white-50 fs-5 mb-0">Thank you, <strong><?php echo htmlspecialchars($fullname); ?></strong>!</p>
                <p class="text-white-50">Your books will be delivered to:</p>
                <p class="fw-bold"><?php echo htmlspecialchars($address); ?></p>
                <div class="order-id text-white-50">
                    Order Reference: <strong class="text-white">#FB-<?php echo str_pad($order_id, 5, '0', STR_PAD_LEFT); ?></strong>
                </div>
                <p class="text-white-50 small mt-2">A confirmation will be sent to your registered email.</p>
                <a href="index.html" class="btn-home" id="homeBtn">Back to Home</a>
            </div>
            <script>
                // Clear cart from localStorage after successful order
                localStorage.removeItem('cartItems');
            </script>
        </body>
        </html>
        <?php
    } else {
        $stmt->close();
        $conn->close();
        echo "<script>alert('Error processing your order. Please try again.'); window.location.href='cart.php';</script>";
    }
} else {
    header("Location: cart.php");
    exit();
}
?>
