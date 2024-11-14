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

// Create the database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS coffee_shop_franchise";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database 'coffee_shop_franchise' created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db("coffee_shop_franchise");

// SQL query to create the BankingSystem table
$sql_create_table = "
CREATE TABLE IF NOT EXISTS BankingSystem (
    BankID INT PRIMARY KEY,                           -- Unique Bank ID
    EmployeeID INT,                                   -- Foreign key linking to Employees table
    Status ENUM('active', 'inactive'),                -- Employment status
    RoutingNumber VARCHAR(20),                        -- Bank routing number
    AccountNumber VARCHAR(20),                        -- Bank account number
    AccountType VARCHAR(20),                          -- Type of bank account (e.g., Savings, Checking)
    BankName VARCHAR(100),                            -- Name of the bank
    FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID)
)";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'BankingSystem' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// SQL query to insert sample data
$sql_insert_data = "
INSERT INTO BankingSystem (BankID, EmployeeID, Status, RoutingNumber, AccountNumber, AccountType, BankName) VALUES
(1, 1, 'active', '123456789', '9876543210', 'Checking', 'Bank of America'),
(2, 2, 'active', '234567890', '8765432109', 'Savings', 'Chase Bank'),
(3, 3, 'active', '345678901', '7654321098', 'Checking', 'Wells Fargo'),
(4, 4, 'inactive', '456789012', '6543210987', 'Savings', 'Citibank'),
(5, 5, 'active', '567890123', '5432109876', 'Checking', 'Capital One'),
(6, 6, 'active', '678901234', '4321098765', 'Savings', 'PNC Bank'),
(7, 7, 'inactive', '789012345', '3210987654', 'Checking', 'TD Bank'),
(8, 8, 'active', '890123456', '2109876543', 'Savings', 'US Bank'),
(9, 9, 'inactive', '901234567', '1098765432', 'Checking', 'BB&T Bank'),
(10, 10, 'active', '012345678', '0987654321', 'Savings', 'SunTrust Bank')
";

// Execute the query to insert sample data
if ($conn->multi_query($sql_insert_data) === TRUE) {
    echo "Sample data inserted successfully.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
