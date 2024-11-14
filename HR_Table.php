<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS coffee_shop_franchise";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database 'coffee_shop_franchise' created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db("coffee_shop_franchise");

// SQL query to create the HR table
$sql_create_table = "
CREATE TABLE IF NOT EXISTS HR (
    BankID INT,                                   -- Foreign key linking to Bank table
    StoreID CHAR(1),                              -- Foreign key linking to Stores table
    EmployeeID INT PRIMARY KEY,                   -- Unique ID for each employee
    WorkingHoursForPayroll INT,                   -- Hours worked during the current payroll period
    TotalWorkingHours INT,                        -- Cumulative hours worked by the employee
    HiringDate DATE,                              -- Employee hiring date
    PhoneNumber VARCHAR(20),                      -- Employee phone number
    Address VARCHAR(255),                         -- Employee address
    Wages DECIMAL(10, 2),                         -- Employee hourly wage or salary
    FOREIGN KEY (BankID) REFERENCES BankingSystem(BankID),
    FOREIGN KEY (StoreID) REFERENCES Stores(StoreID),
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID)
)";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'HR' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// SQL query to insert sample data into the HR table
$sql_insert_data = "
INSERT INTO HR (BankID, StoreID, EmployeeID, WorkingHoursForPayroll, TotalWorkingHours, HiringDate, PhoneNumber, Address, Wages) VALUES
(1, 'A', 1, 40, 1600, '2023-01-15', '555-0123', '101 Main St, New York, NY', 15.00),
(2, 'A', 2, 35, 1400, '2023-02-10', '555-0456', '102 Main St, New York, NY', 12.00),
(3, 'A', 3, 20, 800, '2023-03-01', '555-0789', '103 Main St, New York, NY', 10.00),
(4, 'B', 4, 40, 1600, '2023-04-01', '555-0987', '201 Brew Rd, Los Angeles, CA', 18.00),
(5, 'B', 5, 35, 1400, '2023-05-15', '555-1234', '202 Brew Rd, Los Angeles, CA', 14.00),
(6, 'B', 6, 25, 1000, '2023-06-10', '555-6789', '203 Brew Rd, Los Angeles, CA', 11.00),
(7, 'C', 7, 40, 1600, '2023-07-20', '555-2345', '301 Grind St, Chicago, IL', 16.00),
(8, 'C', 8, 30, 1200, '2023-08-05', '555-3456', '302 Grind St, Chicago, IL', 13.00),
(9, 'C', 9, 20, 800, '2023-09-10', '555-4567', '303 Grind St, Chicago, IL', 10.00),
(10, 'C', 10, 35, 1400, '2023-10-01', '555-5678', '304 Grind St, Chicago, IL', 12.50)
";

// Execute the query to insert sample data
if ($conn->multi_query($sql_insert_data) === TRUE) {
    echo "Sample data inserted successfully into 'HR'.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
