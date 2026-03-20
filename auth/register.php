<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// If already logged in, go home
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: ../index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $email    = sanitize_input($_POST['email']);
    $password = $_POST['password']; // Do NOT sanitize before hashing!

    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required.'); window.location.href='../login.html';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.location.href='../login.html';</script>";
        exit();
    }

    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.'); window.location.href='../login.html';</script>";
        exit();
    }

    // Check if email or username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('An account with that username or email already exists. Please login or use different details.'); window.location.href='../login.html';</script>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Hash password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! You can now log in.'); window.location.href='../login.html';</script>";
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.location.href='../login.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login.html");
    exit();
}
?>
