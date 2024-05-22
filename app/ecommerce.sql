-- Database: ecommerce_db

CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- USER Table
CREATE TABLE USERS (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_role VARCHAR(50),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address TEXT,
    email VARCHAR(100),
    phone_no VARCHAR(20),
    gender CHAR(1),
    age INT,
    password VARCHAR(255),
    status VARCHAR(255)   DEFAULT 'pending'
);

-- COLLECTION_SLOT Table
CREATE TABLE COLLECTION_SLOTS (
    collection_id INT AUTO_INCREMENT PRIMARY KEY,
    collection_date DATE,
    collection_time TIME
);

-- PAYMENT Table
CREATE TABLE PAYMENTS (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    pay_time TIME,
    pay_date DATE,
    pay_method VARCHAR(50),
    pay_amount DECIMAL(10, 2),
    user_id INT,
    order_id INT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (order_id) REFERENCES `ORDER`(order_id)
);

-- CART Table
CREATE TABLE CARTS (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    cart_created DATETIME,
    cart_updated DATETIME,
    cart_items TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id)
);

-- DISCOUNT Table
CREATE TABLE DISCOUNTS (
    discount_id INT AUTO_INCREMENT PRIMARY KEY,
    discount_amount DECIMAL(10, 2),
    discount_percentage DECIMAL(5, 2),
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)
);

-- PRODUCT_CATEGORY Table
CREATE TABLE PRODUCT_CATEGORIES (
    product_category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_type VARCHAR(100),
    no_of_item INT
);

-- ORDER Table
CREATE TABLE `ORDERS` (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_date DATE,
    order_quantity INT,
    total_amount DECIMAL(10, 2),
    invoice_no VARCHAR(100),
    cart_id INT,
    collection_id INT,
    FOREIGN KEY (cart_id) REFERENCES CART(cart_id),
    FOREIGN KEY (collection_id) REFERENCES COLLECTION_SLOT(collection_id)
);

-- WISHLIST Table
CREATE TABLE WISHLISTS (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    wishlist_created_date DATE,
    wishlist_updated_date DATE,
    wishlist_item TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id)
);

-- REVIEW Table
CREATE TABLE REVIEWS (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    review_date DATE,
    review_time TIME,
    review_score INT,
    feedback TEXT,
    user_id INT,
    product_id INT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)
);

-- SHOP Table
CREATE TABLE SHOPS (
    shop_id INT AUTO_INCREMENT PRIMARY KEY,
    shop_name VARCHAR(100),
    shop_address TEXT,
    shop_type VARCHAR(50),
    shop_description TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id)
);

-- PRODUCT Table
CREATE TABLE PRODUCTS (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    product_description TEXT,
    price DECIMAL(10, 2),
    quantity INT,
    stock_check BOOLEAN,
    allergy_info TEXT,
    product_image VARCHAR(255),
    product_category_id INT,
    shop_id INT,
    FOREIGN KEY (product_category_id) REFERENCES PRODUCT_CATEGORY(product_category_id),
    FOREIGN KEY (shop_id) REFERENCES SHOP(shop_id)
);

-- REPORT Table
CREATE TABLE REPORTS (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    report_type VARCHAR(100),
    report_name VARCHAR(100),
    report_time TIME,
    report_date DATE,
    user_id INT,
    order_id INT,
    FOREIGN KEY (user_id) REFERENCES USER(user_id),
    FOREIGN KEY (order_id) REFERENCES `ORDER`(order_id)
);

-- CART_PRODUCT Table
CREATE TABLE CART_PRODUCTS (
    cart_id INT,
    product_id INT,
    PRIMARY KEY (cart_id, product_id),
    FOREIGN KEY (cart_id) REFERENCES CART(cart_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)
);

-- WISHLIST_PRODUCT Table
CREATE TABLE WISHLIST_PRODUCTS (
    wishlist_id INT,
    product_id INT,
    PRIMARY KEY (wishlist_id, product_id),
    FOREIGN KEY (wishlist_id) REFERENCES WISHLIST(wishlist_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)
);

-- ORDER_PRODUCT Table
CREATE TABLE ORDER_PRODUCTS (
    order_id INT,
    product_id INT,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES `ORDER`(order_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)
);

-- PRODUCT_REPORT Table
CREATE TABLE PRODUCT_REPORTS (
    report_id INT,
    product_id INT,
    PRIMARY KEY (report_id, product_id),
    FOREIGN KEY (report_id) REFERENCES REPORT(report_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)
);
