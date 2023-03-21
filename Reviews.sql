CREATE TABLE Reviews (
  ReviewID INT AUTO_INCREMENT PRIMARY KEY,
  BookID INT NOT NULL,
  CustomerID INT,
  Rating INT NOT NULL,
  Review TEXT,
  FOREIGN KEY (BookID) REFERENCES Books(BookID),
  FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
); 
INSERT INTO Reviews (BookID, CustomerID, Rating, Review)
VALUES (1, NULL,)  
