<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "your_database_name"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the AuditLogs table
$sql = "
CREATE TABLE AuditLogs (
    LogID INT PRIMARY KEY AUTO_INCREMENT,       -- Unique identifier for each log entry
    ManagerID INT,                              -- ID of the manager performing the action
    ActionType VARCHAR(50),                     -- Type of action (e.g., 'Department Change', 'Title Update')
    AffectedEmployeeID INT,                     -- ID of the employee affected by the action (if applicable)
    ChangesMade TEXT,                           -- Detailed description of the changes made
    ActionTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp of when the action was performed
    FOREIGN KEY (ManagerID) REFERENCES Employees(EmployeeID)  -- Linking to the Employees table to identify the manager
)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Table AuditLogs created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
