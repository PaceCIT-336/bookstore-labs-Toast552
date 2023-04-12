CREATE TABLE customers (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Address VARCHAR(255) NOT NULL,
    City VARCHAR(255) NOT NULL,
    State CHAR(2) NOT NULL,
    Zip VARCHAR(10) NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL
);

INSERT INTO customers (FirstName, LastName, Address, City, State, Zip, PhoneNumber, Email, Password)
VALUES
    ('John', 'Doe', '123 Main St', 'Anytown', 'CA', '12345', '555-555-1212', 'johndoe@example.com', 'myp@ssword1'),
    ('Jane', 'Smith', '456 Elm St', 'Othertown', 'NY', '67890', '555-555-2121', 'janesmith@example.com', 'secureP@ss123');

ALTER TABLE customers MODIFY Email VARCHAR(255) UNIQUE;
