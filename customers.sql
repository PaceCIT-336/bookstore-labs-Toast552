CREATE TABLE customers (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(255),
    LastName VARCHAR(255),
    Address VARCHAR(255),
    City VARCHAR(255),
    State VARCHAR(255),
    Zip VARCHAR(10),
    PhoneNumber VARCHAR(20),
    Email VARCHAR(255)
);

INSERT INTO customers (FirstName, LastName, Address, City, State, Zip, PhoneNumber, Email)
VALUES
    ('John', 'Doe', '123 Main St', 'Anytown', 'CA', '12345', '555-555-1212', 'johndoe@example.com'),
    ('Jane', 'Smith', '456 Elm St', 'Othertown', 'NY', '67890', '555-555-2121', 'janesmith@example.com');
ALTER TABLE Customers ADD Password VARCHAR(255);
