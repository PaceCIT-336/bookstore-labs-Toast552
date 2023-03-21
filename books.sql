CREATE DATABASE bookstore;
USE bookstore;
CREATE USER 'webapp'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON bookstore.* TO 'webapp'@'localhost';
CREATE TABLE books (
  BookID INT AUTO_INCREMENT PRIMARY KEY,
  Title VARCHAR(255),
  Author VARCHAR(255),
  Description TEXT,
  ImagePath VARCHAR(255),
  Price DECIMAL(10,2)
);

