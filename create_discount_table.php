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

// SQL query to create the DiscountTable
$sql_create_table = "
CREATE TABLE IF NOT EXISTS DiscountTable (
    DiscountID INT PRIMARY KEY AUTO_INCREMENT,  -- Unique ID for each discount
    StoreID CHAR(1),                            -- Foreign key linking to Stores table
    DiscountDescription VARCHAR(255),           -- Description of the discount
    DiscountPercentage INT,                     -- Percentage of the discount
    FOREIGN KEY (StoreID) REFERENCES Stores(StoreID)
)";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'DiscountTable' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// SQL query to insert sample data into the DiscountTable
$sql_insert_data = "
INSERT INTO DiscountTable (StoreID, DiscountDescription, DiscountPercentage) VALUES
('A', '10% off for loyal customers', 10),
('B', '15% off on first purchase', 15),
('C', '5% off for students', 5)
";

// Execute the query to insert sample data
if ($conn->query($sql_insert_data) === TRUE) {
    echo "Sample data inserted successfully into 'DiscountTable'.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
