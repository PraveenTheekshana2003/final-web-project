# 🌐📚 Future Books

Future Books is an interactive e-commerce web platform designed for browsing and purchasing books online. The website features a clean, responsive layout with multiple pages including product exploration, a shopping cart, user authentication, and more. This project was developed as an individual assignment for the COM 2303 - Web Design course.

🔗 **Live Website:** [https://praveentheekshana2003.github.io/final-web-project/](https://praveentheekshana2003.github.io/final-web-project/)

---

## 🚀 Features

- 🏠 **Home Page** – Attractive landing page with top-rated books and service information
- 🔍 **Explore** – Browse and discover available books
- 🛒 **Cart** – Add books to cart and manage selections
- 💳 **Checkout** – Proceed to purchase with a checkout flow
- 🔐 **Login / Register** – User authentication with PHP sessions and password hashing
- 🌙 **Dark Mode** – Toggle between light and dark themes
- 📱 **Responsive Design** – Mobile-friendly layout with smooth navigation

---

## 🛠️ Technologies Used

- **HTML5** – Semantic structure and layout of all pages including headers, content areas, and navigation
- **CSS3** – Custom styling, visual appearance, animations, and responsive layout
- **Bootstrap 5** – Responsive grid system and pre-built UI components
- **JavaScript (ES6)** – Interactive features, dark mode toggle, and enhanced user experience
- **PHP 8** – Backend logic, session handling, cart and checkout processing
- **MySQL** – Database for users and related data
- **Font Awesome** – Icons throughout the interface
- **GitHub Pages** – Live deployment and hosting

---

## 📁 Project Structure

```
final-web-project/
│
├── 📂 auth/                  # Authentication Scripts
│   ├── login.php             # Login logic
│   ├── logout.php            # Session destroy and redirect
│   └── register.php          # Registration logic
│
├── 📂 includes/              # PHP Helper Files
│   ├── db.php                # Database connection
│   └── functions.php         # Helper functions (sanitize, validate)
│
├── 📂 images/                # Visual Assets
│   ├── circular logo.png     # Site favicon
│   ├── logo.png              # Header logo
│   ├── landing image.jpg     # Hero/banner image
│   ├── contact us.png        # Contact section image
│   ├── free shipping.png     # Service feature image
│   ├── gift cards.png        # Service feature image
│   ├── profile.png           # User profile icon
│   └── returning goods.png   # Service feature image
│
├── 📄 index.html             # Landing / Home Page
├── 📄 explore.html           # Book Exploration Page
├── 📄 cart.html              # Shopping Cart Page
├── 📄 cart.php               # Cart Backend Logic
├── 📄 checkout.php           # Checkout Handler
├── 📄 login.html             # User Sign-in Page
├── 📄 session_check.php      # Session Validation
├── 📄 style.css              # Global Stylesheet
├── 📄 script.js              # Global JavaScript
├── 📄 future_books_setup.sql # MySQL Database Export
└── 📄 readme.txt             # Project Notes
```

---

## 🗄️ Database Structure

**Database name:** `future_books`

| Table | Fields |
|---|---|
| `users` | id, username, email, password (hashed), created_at |

> Import `future_books_setup.sql` to set up the database schema.

---

## ⚙️ Setup Instructions

### Requirements
- XAMPP (Apache + MySQL) — download from [apachefriends.org](https://www.apachefriends.org)

### Steps to Run Locally

1. **Clone or download** this repository
2. **Copy** the `final-web-project-master` folder into your XAMPP folder:
   - Windows: `C:\xampp\htdocs\final-web-project-master\`
   - Mac: `/Applications/XAMPP/htdocs/final-web-project-master/`
3. **Start XAMPP** — click Start on both Apache and MySQL
4. **Open phpMyAdmin** at `http://localhost/phpmyadmin`
5. **Create a new database** and import `future_books_setup.sql`
6. **Open the website** at `http://localhost/final-web-project-master/`

> **Or simply visit the live site:** [https://praveentheekshana2003.github.io/final-web-project/](https://praveentheekshana2003.github.io/final-web-project/)

---

## 🔐 User Authentication

- Register a new account at `/login.html`
- Login at `/login.html`
- Passwords are securely hashed using PHP `password_hash()`
- Sessions are managed server-side using PHP `$_SESSION`
- Logout destroys the session via `/auth/logout.php`
- Session validation handled by `session_check.php`

---

## 📈 Future Improvements

- Adding more dynamic JavaScript functionality
- Improving accessibility features
- Enhancing the UI/UX design
- Adding full backend integration for the explore and cart pages
- Optimizing the website for better performance

---

## 👨‍💻 Author

| Field | Details |
|---|---|
| **Student Name** | M.P. Theekshana |
| **Index No** | 6316 |
| **Registration No** | ASP/2023/165 |
| **Course** | COM 2303 – Web Design |
| **Project Type** | Individual Project |
| **GitHub** | [https://github.com/praveentheekshana2003](https://github.com/praveentheekshana2003) |
