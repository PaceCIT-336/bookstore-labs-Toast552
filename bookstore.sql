CREATE TABLE books (
    BookID INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255),
    Author VARCHAR(255),
    Description TEXT,
    ImagePath VARCHAR(255),
    Price DECIMAL(10,2)
);
INSERT INTO books (Title, Author, Description, ImagePath, Price)
VALUES
    ('The Great Gatsby', 'F. Scott Fitzgerald', 'A classic novel about the roaring twenties', 'images/greatgatsby.jpg', 12.99),
    ('To Kill a Mockingbird', 'Harper Lee', 'A coming-of-age story about racism and injustice in the deep south', 'images/tokillamockingbird.jpg', 14.99),
    ('The Catcher in the Rye', 'J.D. Salinger', 'A controversial novel about teenage angst and rebellion', 'images/catcherintherye.jpg', 9.99);
