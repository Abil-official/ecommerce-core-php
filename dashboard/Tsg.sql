-------------------Admin Dashboard---------------------
-- Users Table
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'trader', 'customer') NOT NULL,
    profile_image VARCHAR(255)
);
-- Inserting Users
INSERT INTO Users (username, password, email, role, profile_image) VALUES
('admin', 'hashed_password', 'admin@example.com', 'admin', 'profile.png'),
('trader1', 'hashed_password', 'trader1@example.com', 'trader', 'profile.png'),
('customer1', 'hashed_password', 'customer1@example.com', 'customer', 'profile.png');


-- Orders Table
CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    order_date DATE NOT NULL,
    payment_method ENUM('Esewa', 'Credit Card', 'Cash on Delivery') NOT NULL,
    order_status ENUM('Completed', 'Pending', 'Process') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
-- Inserting Orders
INSERT INTO Orders (user_id, order_date, payment_method, order_status) VALUES
(3, '2024-05-16', 'Esewa', 'Completed'),
(3, '2024-05-16', 'Credit Card', 'Pending');

-- Products Table
CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    category VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Inserting Products
INSERT INTO Products (product_name, description, price, stock, category) VALUES
('Product 1', 'Description of product 1', 19.99, 100, 'Category 1'),
('Product 2', 'Description of product 2', 29.99, 150, 'Category 2');


-- OrderDetails Table
CREATE TABLE OrderDetails (
    order_detail_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);
-- Inserting Order Details
INSERT INTO OrderDetails (order_id, product_id, quantity, price) VALUES
(1, 1, 2, 19.99),
(1, 2, 1, 29.99);


-- Payments Table
CREATE TABLE Payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    payment_method ENUM('Esewa', 'Credit Card', 'Cash on Delivery') NOT NULL,
    payment_status ENUM('Paid', 'Pending', 'Failed') NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);
-- Inserting Payments
INSERT INTO Payments (order_id, payment_method, payment_status) VALUES
(1, 'Esewa', 'Paid'),
(2, 'Credit Card', 'Pending');

-- Reviews Table
CREATE TABLE Reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    product_id INT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);
-- Inserting Reviews
INSERT INTO Reviews (user_id, product_id, rating, comment) VALUES
(3, 1, 5, 'Excellent product!'),
(3, 2, 4, 'Very good product.');


-- Queries Table
CREATE TABLE Queries (
    query_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    query_text TEXT NOT NULL,
    query_status ENUM('Open', 'In Progress', 'Closed') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
-- Inserting Queries
INSERT INTO Queries (user_id, query_text, query_status) VALUES
(3, 'How can I track my order?', 'Open');


-- Traders Table
CREATE TABLE Traders (
    trader_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    trader_name VARCHAR(100) NOT NULL,
    contact_info VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);


-- Inserting Traders
INSERT INTO Traders (user_id, trader_name, contact_info) VALUES
(2, 'Trader One', 'trader1@example.com');

--------------------Traders Dashboard--------------------

-- Table: Users
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    UserName VARCHAR(100),
    ProfilePicture VARCHAR(255)
);
-- Inserting data into the Users table
INSERT INTO Users (UserName, ProfilePicture) VALUES
    ('Preshna Adhikari', 'user.png'),
    ('Simran Shrestha', 'user.png'),
    ('Riya Shrestha', 'user.png'),
    ('Anshu Kharel', 'user.png'),
    ('Aseena Subedi', 'user.png');

-- Table: Orders
CREATE TABLE Orders (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    DateOrdered DATE,
    PaymentMethod VARCHAR(50),
    OrderStatus ENUM('Pending', 'Process', 'Completed'),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);
-- Inserting data into the Orders table
INSERT INTO Orders (UserID, DateOrdered, PaymentMethod, OrderStatus) VALUES
    (1, '2024-03-10', 'Esewa', 'Completed'),
    (2, '2024-03-10', 'Esewa', 'Pending'),
    (3, '2024-03-10', 'Esewa', 'Process'),
    (4, '2024-03-10', 'Esewa', 'Pending'),
    (5, '2024-03-10', 'Esewa', 'Completed');

-- Table: Revenue
CREATE TABLE Revenue (
    RevenueID INT PRIMARY KEY AUTO_INCREMENT,
    TotalRevenue DECIMAL(10, 2)
);
-- Inserting data into the Revenue table
INSERT INTO Revenue (TotalRevenue) VALUES (2543.00);


-- Table: Customers
CREATE TABLE Customers (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    TotalCustomers INT
);
-- Inserting data into the Customers table
INSERT INTO Customers (TotalCustomers) VALUES (120);


-- Table: Activities
CREATE TABLE Activities (
    ActivityID INT PRIMARY KEY AUTO_INCREMENT,
    Task VARCHAR(50),
    HoursPerDay INT
);

-- Inserting data into the Activities table
INSERT INTO Activities (Task, HoursPerDay) VALUES
    ('Work', 11),
    ('Eat', 2),
    ('Commute', 2),
    ('Watch TV', 2),
    ('Sleep', 7);
