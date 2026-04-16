-- Create database
CREATE DATABASE IF NOT EXISTS testdb;

-- Use the database
USE testdb;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

-- Insert test users
INSERT INTO users (username, password) VALUES 
('admin', 'password123'),
('user', 'test123'),
('john', 'doe123');

-- Show all users
SELECT * FROM users;
