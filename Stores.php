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

// SQL query to create the Stores table
$sql_create_table = "
CREATE TABLE IF NOT EXISTS Stores (
    StoreID CHAR(1) PRIMARY KEY,             -- Store ID between A and C
    Address VARCHAR(255),                    -- Realistic address
    Vendor VARCHAR(100),                     -- Vendor supplying each store
    OperatingHours VARCHAR(50)               -- Store operating hours
)";

// Execute the query to create the table
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'Stores' created or already exists.<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// SQL query to insert sample data into the Stores table
$sql_insert_data = "
INSERT INTO Stores (StoreID, Address, Vendor, OperatingHours) VALUES
('A', '123 Coffee Lane, New York, NY', 'Premium Beans Supplier', '6 AM - 8 PM'),
('B', '456 Brew Ave, Los Angeles, CA', 'Quality Roast Co.', '7 AM - 9 PM'),
('C', '789 Grind St, Chicago, IL', 'Fresh Grounds Supplier', '5 AM - 10 PM')
";

// Execute the query to insert sample data
if ($conn->multi_query($sql_insert_data) === TRUE) {
    echo "Sample data inserted successfully into 'Stores'.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
