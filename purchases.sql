CREATE TABLE Purchases (
  PurchaseID INT AUTO_INCREMENT PRIMARY KEY,
  BookID INT NOT NULL,
  CustomerID INT NOT NULL,
  OrderDate DATE NOT NULL,
  FOREIGN KEY (BookID) REFERENCES Books(BookID),
  FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID)
);
INSERT INTO Purchases (BookID, CustomerID, OrderDate)
VALUES (1, 1, '2022-01-01'),
       (2, 2, '2022-01-02'); 