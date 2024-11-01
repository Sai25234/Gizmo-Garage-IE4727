CREATE TABLE Categories (
    CategoryID INT PRIMARY KEY,
    CategoryName VARCHAR(100) NOT NULL,
    CategoryType VARCHAR(50) NULL
);

CREATE TABLE Products (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,
    ProductName VARCHAR(100) NOT NULL,
    Brand VARCHAR(100),
    Category VARCHAR(100),
    Image_url VARCHAR(255),
    Price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    SalePrice DECIMAL(10,2) DEFAULT NULL,
    Stock INT NOT NULL
);


CREATE TABLE Customers (
    Email VARCHAR(100) UNIQUE NOT NULL CHECK (Email LIKE '%_@__%.__%'),
    Password VARCHAR(100) UNIQUE NOT NULL
);  

CREATE TABLE Orders (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,
    CustomerName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL CHECK (Email LIKE '%_@__%.__%'),
    Phone VARCHAR(15) CHECK (LENGTH(Phone) BETWEEN 10 AND 15),
    Address TEXT,
    PaymentDetails TEXT,
    Status VARCHAR(50) NOT NULL CHECK (Status IN ('Pending', 'Processing', 'Completed', 'Cancelled')),
    Total DECIMAL(10, 2),
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (Email) REFERENCES Customers(Email) ON DELETE CASCADE
);

CREATE TABLE OrderItems (
    OrderID INT,
    ProductID INT,
    Quantity INT NOT NULL,
    PRIMARY KEY (OrderID, ProductID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);




