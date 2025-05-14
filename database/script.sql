CREATE TABLE Customer (
    Customer_ID INT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE Product (
    Product_ID INT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Price NUMERIC(10,2) NOT NULL,
    Description TEXT
);

CREATE TABLE Category (
    Category_ID INT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Picture VARCHAR(255),
    Description TEXT
);

CREATE TABLE Order (
    Order_ID INT PRIMARY KEY,
    Customer_ID INT NOT NULL,
    Order_Amount NUMERIC(10,2) NOT NULL,
    Order_Date DATE NOT NULL,
    FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);

CREATE TABLE Payment (
    Payment_ID INT PRIMARY KEY,
    Order_ID INT NOT NULL,
    Type VARCHAR(50) NOT NULL,
    Amount NUMERIC(10,2) NOT NULL,
    FOREIGN KEY (Order_ID) REFERENCES Order(Order_ID)
);

CREATE TABLE Cart (
    Cart_ID INT PRIMARY KEY,
    Customer_ID INT NOT NULL,
    FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);

CREATE TABLE Cart_Product (
    Cart_ID INT NOT NULL,
    Product_ID INT NOT NULL,
    Quantity INT NOT NULL DEFAULT 1,
    PRIMARY KEY (Cart_ID, Product_ID),
    FOREIGN KEY (Cart_ID) REFERENCES Cart(Cart_ID),
    FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID)
);

CREATE TABLE Category_Product (
    Category_ID INT NOT NULL,
    Product_ID INT NOT NULL,
    PRIMARY KEY (Category_ID, Product_ID),
    FOREIGN KEY (Category_ID) REFERENCES Category(Category_ID),
    FOREIGN KEY (Product_ID) REFERENCES Product(Product_ID)
);
