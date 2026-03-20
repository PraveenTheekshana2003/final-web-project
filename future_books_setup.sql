-- ============================================================
-- FUTURE BOOKS - Database Setup Script
-- Database: future_books
--
-- HOW TO USE:
-- 1. Open phpMyAdmin (http://localhost/phpmyadmin)
-- 2. Create a database named: future_books
--    (Collation: utf8mb4_general_ci)
-- 3. Click on the "future_books" database
-- 4. Click the "SQL" tab
-- 5. Paste this entire file and click "Go"
-- ============================================================

USE future_books;

-- ============================================================
-- 1. USERS TABLE
-- ============================================================
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(100) NOT NULL UNIQUE,
    email      VARCHAR(150) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Demo users (password for ALL: Demo@1234)
-- Uses INSERT IGNORE to skip if already inserted
INSERT IGNORE INTO users (username, email, password) VALUES
('Kasun Perera',      'kasun@gmail.com',       '$2y$10$1Hb6ozI0B.q2l//RwqSpQ.m7baC.43apsoO0feYGMSFQgeCgGfaiy'),
('Nimasha Silva',     'nimasha@gmail.com',      '$2y$10$CaEjkIvB3VF/BGatQTzEWOF0xzyL2z1zV7JOJbAbq218ljikShuu6'),
('Raveen Fernando',   'raveen@gmail.com',       '$2y$10$XF1qIZfkqcG9QPbjbb2tOeHE/ppFKZXtU5sND2lylq1wNHx.cArHO'),
('Dilini Jayawardena','dilini@yahoo.com',       '$2y$10$Nc8rRC5P4sCxBGpMjmtVZ.xHdjzXnSSzqRIvUNfrLyYG1TpNU368O'),
('Sampath Wickrama',  'sampath@hotmail.com',    '$2y$10$r0Yswd.vkhbxHGp3h.ojCulr9EJCfpVSNf5mVesuTQRD6lRZ335T6');


-- ============================================================
-- 2. ORDERS TABLE
-- ============================================================
CREATE TABLE IF NOT EXISTS orders (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT NULL,
    fullname   VARCHAR(100) NOT NULL,
    address    TEXT NOT NULL,
    contact    VARCHAR(50) NOT NULL,
    cart_data  LONGTEXT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample orders (only inserted if orders table is empty)
INSERT INTO orders (user_id, fullname, address, contact, cart_data)
SELECT * FROM (
    SELECT
        1,
        'Kasun Perera',
        '45/A, Galle Road, Colombo 03, Western Province',
        '+94771234567',
        '[{"id":1700000001,"title":"The Da Vinci Code","price":"1500.00","image":"https://jumpbooks.lk/wp-content/uploads/2022/04/The-Da-Vinci-Code-.jpg"}]'
    UNION ALL SELECT
        2,
        'Nimasha Silva',
        '12, Kandy Road, Peradeniya, Central Province',
        '+94719876543',
        '[{"id":1700000002,"title":"Wassana Sihinaya","price":"720.00","image":"https://grantha.lk/media/catalog/product/cache/25fccda23befa3a8b49210419c7720b7/w/a/wassana_sihinaya_front.jpg"}]'
    UNION ALL SELECT
        3,
        'Raveen Fernando',
        '78/B, Station Road, Galle, Southern Province',
        '+94764567890',
        '[{"id":1700000003,"title":"Ikigai","price":"720.00","image":"https://jumpbooks.lk/wp-content/uploads/2019/03/Ikigai.jpg"}]'
    UNION ALL SELECT
        NULL,
        'Guest User',
        '33, Temple Street, Matara, Southern Province',
        '+94703210987',
        '[{"id":1700000004,"title":"English Novel","price":"720.00","image":"https://res.cloudinary.com/bloomsbury-atlas/image/upload/w_360,c_scale,dpr_1.5/jackets/9781408855652.jpg"}]'
    UNION ALL SELECT
        4,
        'Dilini Jayawardena',
        '5/1, Rajapihilla Mawatha, Kurunegala, North Western Province',
        '+94776543210',
        '[{"id":1700000005,"title":"The Da Vinci Code","price":"1500.00","image":"https://jumpbooks.lk/wp-content/uploads/2022/04/The-Da-Vinci-Code-.jpg"}]'
) AS tmp
WHERE (SELECT COUNT(*) FROM orders) = 0;


-- ============================================================
-- VERIFICATION (run these to confirm everything worked)
-- ============================================================
SELECT id, username, email, created_at FROM users;
SELECT id, fullname, address, contact, order_date FROM orders;
SELECT COUNT(*) AS total_users FROM users;
SELECT COUNT(*) AS total_orders FROM orders;
