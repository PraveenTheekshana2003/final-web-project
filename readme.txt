# 📚 Future Books
### *Your Next Chapter Awaits*

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap_5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Live Demo](https://img.shields.io/badge/Live%20Demo-GitHub%20Pages-222222?style=for-the-badge&logo=github&logoColor=white)](https://praveentheekshana2003.github.io/final-web-project/)

> A full-featured **online bookstore** web application with cart management, user authentication, and a curated collection of Sinhala and English books — built as a final web development project.

🌐 **[View Live Demo](https://praveentheekshana2003.github.io/final-web-project/)** · 🐛 **[Report Bug](https://github.com/praveentheekshana2003/final-web-project/issues)** · ✨ **[Request Feature](https://github.com/praveentheekshana2003/final-web-project/issues)**

---

## 📋 Table of Contents

- [🌟 Overview](#-overview)
- [✨ Features](#-features)
- [🛠️ Tech Stack](#️-tech-stack)
- [📁 File Structure](#-file-structure)
- [⚙️ Getting Started](#️-getting-started)
- [🗄️ Database Setup](#️-database-setup)
- [📖 Pages & Functionality](#-pages--functionality)
- [🚀 Deployment](#-deployment)
- [🔮 Future Improvements](#-future-improvements)
- [👨‍💻 Author](#-author)

---

## 🌟 Overview

**Future Books** is a responsive e-commerce web application designed for book lovers. It brings together a clean, modern UI with backend-powered authentication and order management. Whether you're browsing bestselling Sinhala novels or adding books to your cart, the experience is smooth, intuitive, and visually appealing.

This project was developed as the **Final Assignment** for a Web Design & Development course at the **Faculty of Applied Sciences, Rajarata University of Sri Lanka**.

---

## ✨ Features

| Feature | Description |
|---|---|
| 🌓 **Dark / Light Mode** | Toggle between themes — preference saved across sessions via `localStorage` |
| 📚 **Book Carousel** | Smooth browsing carousel for Bestsellers and Top-Rated collections |
| 🛒 **Shopping Cart** | Add books, view cart summary, and proceed to checkout |
| 🔐 **User Authentication** | Register, login, and logout with PHP session management |
| 📦 **Order Checkout** | Collect delivery details and store orders in MySQL |
| 🔍 **Explore & Filter** | Browse and filter books by category on the Explore page |
| 📱 **Responsive Design** | Fully mobile-friendly layout using Bootstrap 5 and custom CSS |
| 💎 **Glass-card UI** | Modern glassmorphism-styled feature cards |
| 🌏 **UTF-8 / Sinhala Support** | Full `utf8mb4` database charset for multilingual content |
| 🗺️ **Service Map** | Embedded map section showcasing service locations |

---

## 🛠️ Tech Stack

**Frontend**
- **HTML5** — Semantic markup and page structure
- **CSS3** — Custom styling, animations, and glassmorphism effects
- **JavaScript (ES6+)** — Cart logic, dark mode, carousel, and dynamic rendering
- **Bootstrap 5** — Responsive grid, components, and utilities
- **Font Awesome 4.7** — Icon set used throughout the UI

**Backend**
- **PHP 8+** — Server-side logic for authentication, sessions, and checkout
- **MySQL** — Relational database for users and orders
- **XAMPP / MySQLi** — Local development environment

**Hosting**
- **GitHub Pages** — Static frontend deployment
- **XAMPP (Apache + MySQL)** — Local full-stack development server

---

## 📁 File Structure

```
final-web-project-master/
│
├── index.html               # Home page — hero, features, top-rated books, map
├── about.html               # About Us page
├── explore.html             # Browse & filter all books
├── login.html               # Login UI (frontend form)
├── cart.html                # Static cart view
├── cart.php                 # Dynamic cart with PHP session data
├── checkout.php             # Checkout form — saves orders to database
├── session_check.php        # Validates if user session is active (used by JS)
├── style.css                # Global stylesheet (dark mode, glass cards, layout)
├── script.js                # Client-side JS — cart, dark mode, carousel, filters
├── future_books_setup.sql   # Full MySQL database schema + demo data
│
├── auth/
│   ├── login.php            # Handles login form submission & session creation
│   ├── logout.php           # Destroys session and redirects
│   └── register.php         # Handles new user registration
│
├── includes/
│   ├── db.php               # MySQL database connection (MySQLi)
│   └── functions.php        # Reusable helper functions
│
├── images/
│   ├── logo.png             # Full site logo (header)
│   ├── circular logo.png    # Favicon / circular logo variant
│   ├── landing image.jpg    # Hero section background image
│   ├── free shipping.png    # Feature icon — Free Shipping
│   ├── returning goods.png  # Feature icon — 30 Days Return
│   ├── gift cards.png       # Feature icon — Gift Cards
│   ├── contact us.png       # Feature icon — Contact Us
│   └── profile.png          # User profile avatar placeholder
│
└── .vscode/
    └── settings.json        # VS Code workspace settings
```

---

## ⚙️ Getting Started

### Prerequisites

Make sure you have the following installed:

- [XAMPP](https://www.apachefriends.org/) — Apache + MySQL + PHP
- A modern browser (Chrome, Firefox, Edge)
- [Git](https://git-scm.com/) *(optional, for cloning)*

### Installation

**1. Clone the repository**

```bash
git clone https://github.com/praveentheekshana2003/final-web-project.git
```

**2. Move to XAMPP's web root**

```bash
# Windows
move final-web-project C:\xampp\htdocs\final-web-project

# macOS / Linux
mv final-web-project /opt/lampp/htdocs/final-web-project
```

**3. Start XAMPP**
- Open the XAMPP Control Panel
- Start **Apache** ✅
- Start **MySQL** ✅

**4. Set up the database** *(see section below)*

**5. Open in your browser**

```
http://localhost/final-web-project/
```

> ⚠️ **Note:** If your MySQL runs on a custom port (e.g. `3307`), update the `$port` value in `includes/db.php` to match your XAMPP configuration.

---

## 🗄️ Database Setup

**Step 1** — Open phpMyAdmin at `http://localhost/phpmyadmin`

**Step 2** — Create a new database:

```
Name:      futurebooks_fixed
Collation: utf8mb4_general_ci
```

**Step 3** — Click the **SQL** tab, paste the full contents of `future_books_setup.sql`, and click **Go**.

This creates the `users` and `orders` tables along with 5 pre-loaded demo accounts.

**Demo Login Credentials**

| Username | Email | Password |
|---|---|---|
| Kasun Perera | kasun@gmail.com | `Demo@1234` |
| Nimasha Silva | nimasha@gmail.com | `Demo@1234` |
| Raveen Fernando | raveen@gmail.com | `Demo@1234` |
| Dilini Jayawardena | dilini@yahoo.com | `Demo@1234` |
| Sampath Wickrama | sampath@hotmail.com | `Demo@1234` |

---

## 📖 Pages & Functionality

### 🏠 Home — `index.html`
Full-screen hero section with a call-to-action, glassmorphism feature cards (Free Shipping, 30-Day Return, Gift Cards, Contact), a book carousel for bestselling Sinhala novels, a top-rated books section, and an embedded service map.

### 🔍 Explore — `explore.html`
Full book catalogue with JavaScript-powered category filtering — no page reload required.

### 🛒 Cart — `cart.php`
Renders cart items stored in `localStorage`. Displays item titles, prices, and totals with a proceed-to-checkout button.

### 💳 Checkout — `checkout.php`
Collects delivery details (name, address, contact) and saves the completed order to the MySQL `orders` table.

### 🔐 Login & Register — `auth/login.php` · `auth/register.php`
Login validates credentials against the database and creates a PHP session on success. Registration hashes passwords with `password_hash()` before storing them securely.

### 🔌 Session Check — `session_check.php`
A lightweight endpoint called via `fetch()` from JavaScript. Returns JSON indicating whether a user is logged in — used to guard the *Add to Cart* action.

---

## 🚀 Deployment

The static frontend is live on GitHub Pages:

🔗 **https://praveentheekshana2003.github.io/final-web-project/**

> **Note:** The live demo serves static HTML/CSS/JS only. PHP backend features — login, session-based cart, and checkout — require a local PHP + MySQL server (XAMPP) to function fully.

---

## 🔮 Future Improvements

- [ ] 🔎 **Search functionality** — Search books by title or author
- [ ] 🌐 **Full backend deployment** — Host PHP + MySQL on a live server (cPanel, Railway, etc.)
- [ ] 💳 **Payment gateway** — Integrate Stripe or PayPal for real transactions
- [ ] 👤 **User profile page** — View order history and manage account details
- [ ] ♿ **Accessibility improvements** — ARIA labels, keyboard navigation, contrast fixes
- [ ] ⚡ **Performance optimization** — Lazy-load images, minify CSS and JS assets
- [ ] 📧 **Email notifications** — Send order confirmation emails via PHPMailer
- [ ] 🔑 **Password reset flow** — Forgot password with email verification

---

## 👨‍💻 Author

**Praveen Theekshana**
Second Year Computer Science Student
Faculty of Applied Sciences, Rajarata University of Sri Lanka

- Student ID: `ASP/2023/165` · Index: `6316`
- GitHub: [@praveentheekshana2003](https://github.com/praveentheekshana2003)

---

*If you found this project helpful, please consider giving it a ⭐ — it means a lot!*
