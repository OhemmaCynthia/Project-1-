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

// SQL query to create the LoyalCustomer table
$sql_create_table = "
CREATE TABLE IF NOT EXISTS LoyalCustomer (
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,     -- Unique ID for each customer
    StoreID CHAR(1),                               -- Foreign key linking to Stores table
    CustomerName VARCHAR(100),                     -- Realistic customer name
    PhoneNumber VARCHAR(20),                       -- Realistic phone number
    TotalSpentThisYear DECIMAL(10, 2),             -- Total spent by the customer this year
    FOREIGN KEY (StoreID) REFERENCES Stores(StoreID)
)";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'LoyalCustomer' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// SQL query to insert sample data into the LoyalCustomer table
$sql_insert_data = "
INSERT INTO LoyalCustomer (StoreID, CustomerName, PhoneNumber, TotalSpentThisYear) VALUES
('A', 'Alice Johnson', '555-1111', 250.75),
('B', 'Bob Smith', '555-2222', 320.50),
('C', 'Cathy Brown', '555-3333', 150.00)
";

// Execute the query to insert sample data
if ($conn->multi_query($sql_insert_data) === TRUE) {
    echo "Sample data inserted successfully into 'LoyalCustomer'.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
