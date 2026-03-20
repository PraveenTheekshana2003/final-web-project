<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your Cart | Future Books</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/circular logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .cart-container {
            padding: 150px 0 100px;
        }

        .cart-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .book-thumb {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .checkout-form {
            background: var(--sub-element-bg);
            padding: 40px;
            border-radius: 20px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            border-radius: 10px;
            padding: 12px;
        }

        .checkout-btn {
            background: var(--link-hover-color);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 50px;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .empty-cart {
            text-align: center;
            padding: 100px 0;
        }

        .payment-icon {
            font-size: 2rem;
            margin-right: 15px;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="header-content-div">
            <a href="index.html">
                <img src="images/logo.png" alt="Company Logo" id="header-img" />
            </a>
            <nav id="nav-bar">
                <a href="explore.html" class="nav-link">EXPLORE</a>
                <a href="index.html#top-rated" class="nav-link">TOP RATED</a>
                <a href="about.html" class="nav-link">ABOUT</a>
                <a href="auth/logout.php" class="nav-link">LOGOUT (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
                <div class="toggle-container">
                    <label class="toggle-switch">
                        <input type="checkbox" id="darkModeToggle">
                        <span class="slider"></span>
                    </label>
                </div>
            </nav>
        </div>
    </header>

    <div class="container cart-container">
        <h1 class="fw-bold mb-5"><i class="fa fa-shopping-cart me-3"></i>Your Shopping Cart</h1>

        <div class="row" id="cartContent">
            <div class="col-lg-7">
                <div id="cartItemsList">
                    <!-- Multiple cart items will be injected here -->
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="explore.html" class="btn btn-outline-light rounded-pill px-4"><i class="fa fa-arrow-left me-2"></i>Continue Shopping</a>
                    <button class="btn btn-outline-danger rounded-pill px-4" onclick="clearCart()"><i class="fa fa-trash me-2"></i>Clear All</button>
                </div>

                <div class="cart-card mt-4">
                    <h4 class="fw-bold mb-4">Summary</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Number of Items</span>
                        <span id="itemCount">0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span id="subtotal">Rs. 0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span class="text-success">FREE</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-0">
                        <h4 class="fw-bold">Total</h4>
                        <h4 class="fw-bold" id="totalPrice">Rs. 0.00</h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="checkout-form">
                    <h4 class="fw-bold mb-4">Secure Checkout</h4>
                    <form action="checkout.php" method="POST" id="checkoutForm" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required placeholder="John Doe" pattern="[A-Za-z\s]{2,}" title="Please enter a valid full name (letters only)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Delivery Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required
                                placeholder="Your address in Sri Lanka"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="tel" name="contact" id="contact" class="form-control" required placeholder="+94 77 XXX XXXX" pattern="(\+94|0)[0-9]{9,10}" title="Enter a valid Sri Lankan number e.g. +94771234567">
                        </div>
                        <input type="hidden" name="cart_data" id="cartDataInput">
                        <div class="mt-4">
                            <p class="small text-white-50 mb-3">Accepted Payment Methods</p>
                            <i class="fa fa-cc-visa payment-icon"></i>
                            <i class="fa fa-cc-mastercard payment-icon"></i>
                            <i class="fa fa-cc-paypal payment-icon"></i>
                        </div>
                        <button type="submit" class="checkout-btn">PROCEED TO PAY</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="emptyMessage" class="empty-cart" style="display: none;">
            <i class="fa fa-shopping-basket mb-4" style="font-size: 5rem; opacity: 0.3;"></i>
            <h3>Your cart is empty</h3>
            <p class="text-white-50">Go back and select some amazing books!</p>
            <a href="index.html" class="btn btn-outline-light rounded-pill px-4 mt-3">Browse Books</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <section class="d-flex justify-content-between p-4" style="background-color:#F7F745; color: black;">
            <div class="me-5">
                <span style="font-size:22px;">Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-whatsapp"></a>
                <a href="#" class="fa fa-youtube"></a>
            </div>
        </section>

        <section class="">
            <div class="container text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Future Books</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>Your ultimate destination for discovering amazing stories and expanding your knowledge.</p>
                    </div>

                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Categories</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><a href="explore.html" class="text-white" onclick="localStorage.setItem('filter', 'sinhala-novel')">Sinhala Novels</a></p>
                        <p><a href="explore.html" class="text-white" onclick="localStorage.setItem('filter', 'english-novel')">English Novels</a></p>
                        <p><a href="explore.html" class="text-white" onclick="localStorage.setItem('filter', 'sinhala-poem')">Sinhala Poems</a></p>
                        <p><a href="explore.html" class="text-white">Browse All</a></p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><a href="index.html" class="text-white">Home</a></p>
                        <p><a href="about.html" class="text-white">About Us</a></p>
                        <p><a href="cart.php" class="text-white">My Cart</a></p>
                        <p><a href="index.html#map" class="text-white">Location</a></p>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold">Contact Us</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <address>&#127968; Madangahawattha,<br /> Navinna Road, Galle.</address>
                        <p>&#9993; info@futurebooks.lk</p>
                        <p>&#9742; +94 766 980 713</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center p-3" style="background-color:rgba(0, 0, 0, 0.2);">
            © 2026 Copyright:
            <span class="text-white">Future Books - All Rights Reserved</span>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        // Explicitly render cart when this PHP page loads
        document.addEventListener('DOMContentLoaded', function () {
            renderCart();
        });

        document.getElementById('checkoutForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const fullname = document.getElementById('fullname').value.trim();
            const address = document.getElementById('address').value.trim();
            const contact = document.getElementById('contact').value.trim();
            const cartItems = localStorage.getItem('cartItems');

            // Validate cart
            if (!cartItems || JSON.parse(cartItems).length === 0) {
                alert("Your cart is empty! Please add items before checking out.");
                return;
            }

            // Validate fullname — allow letters, spaces, and common name characters
            if (fullname.length < 2) {
                alert("Please enter your full name (at least 2 characters).");
                document.getElementById('fullname').focus();
                return;
            }

            // Validate address
            if (address.length < 10) {
                alert("Please enter a complete delivery address.");
                document.getElementById('address').focus();
                return;
            }

            // Validate contact - Sri Lankan number
            if (!/^(\+94|0)[0-9]{9,10}$/.test(contact.replace(/\s/g, ''))) {
                alert("Please enter a valid Sri Lankan contact number (e.g. +94771234567 or 0771234567).");
                document.getElementById('contact').focus();
                return;
            }

            // All valid — inject cart data and submit
            document.getElementById('cartDataInput').value = cartItems;
            this.submit();
        });
    </script>
</body>

</html>
