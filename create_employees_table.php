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

// SQL query to create the Employees table
$sql_create_table = "
CREATE TABLE IF NOT EXISTS Employees (
    EmployeeID INT PRIMARY KEY,              -- Employee ID between 1 and 10
    FirstName VARCHAR(50),                   -- Random first name
    LastName VARCHAR(50),                    -- Random last name
    JobTitle VARCHAR(50),                    -- Job title (e.g., barista, manager)
    Department VARCHAR(50),                  -- Department (e.g., front of house, back of house)
    StoreID CHAR(1),                         -- Foreign key linking to Stores table
    IsManager BOOLEAN DEFAULT FALSE,         -- Designates if employee is a manager
    PhoneNumber VARCHAR(20),                 -- Random, realistic phone number
    Address VARCHAR(255),                    -- Realistic address
    HiringDate DATE,                         -- Random hiring date
    FOREIGN KEY (StoreID) REFERENCES Stores(StoreID)
)";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'Employees' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// SQL query to insert sample data into the Employees table
$sql_insert_data = "
INSERT INTO Employees (EmployeeID, FirstName, LastName, JobTitle, Department, StoreID, IsManager, PhoneNumber, Address, HiringDate) VALUES
(1, 'John', 'Doe', 'Manager', 'Management', 'A', TRUE, '555-0123', '101 Main St, New York, NY', '2023-01-15'),
(2, 'Emily', 'Smith', 'Barista', 'Front of House', 'A', FALSE, '555-0456', '102 Main St, New York, NY', '2023-02-10'),
(3, 'Michael', 'Brown', 'Cashier', 'Front of House', 'A', FALSE, '555-0789', '103 Main St, New York, NY', '2023-03-01'),
(4, 'Sarah', 'Johnson', 'Manager', 'Management', 'B', TRUE, '555-0987', '201 Brew Rd, Los Angeles, CA', '2023-04-01'),
(5, 'Chris', 'Davis', 'Barista', 'Front of House', 'B', FALSE, '555-1234', '202 Brew Rd, Los Angeles, CA', '2023-05-15'),
(6, 'Pat', 'Martinez', 'Cashier', 'Back of House', 'B', FALSE, '555-6789', '203 Brew Rd, Los Angeles, CA', '2023-06-10'),
(7, 'Jessica', 'Wilson', 'Manager', 'Management', 'C', TRUE, '555-2345', '301 Grind St, Chicago, IL', '2023-07-20'),
(8, 'David', 'Lopez', 'Barista', 'Front of House', 'C', FALSE, '555-3456', '302 Grind St, Chicago, IL', '2023-08-05'),
(9, 'Sophia', 'Lee', 'Cashier', 'Back of House', 'C', FALSE, '555-4567', '303 Grind St, Chicago, IL', '2023-09-10'),
(10, 'Ryan', 'Kim', 'Barista', 'Front of House', 'C', FALSE, '555-5678', '304 Grind St, Chicago, IL', '2023-10-01')
";

// Execute the query to insert sample data
if ($conn->multi_query($sql_insert_data) === TRUE) {
    echo "Sample data inserted successfully into 'Employees'.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
