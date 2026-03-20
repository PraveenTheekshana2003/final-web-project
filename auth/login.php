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
    $email    = sanitize_input($_POST['email']);
    $password = $_POST['password']; // Never sanitize before verify!

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please enter both email and password.'); window.location.href='../login.html';</script>";
        exit();
    }

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password correct — start a new session
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION['user_id']   = $row['id'];
            $_SESSION['username']  = $row['username'];
            $_SESSION['email']     = $email;
            $_SESSION['logged_in'] = true;

            // Redirect to cart if that's where they were going, otherwise home
            $redirect = isset($_POST['redirect']) && !empty($_POST['redirect'])
                ? '../' . basename($_POST['redirect'])
                : '../index.html';

            header("Location: " . $redirect);
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href='../login.html';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email address.'); window.location.href='../login.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login.html");
    exit();
}
?>
