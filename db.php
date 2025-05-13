<!-- filepath: c:\Users\gupta\Desktop\NSP Project\create_database.php -->
<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "voting_system"; // Name of the database to create

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database (optional, remove if the database is already created)
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql); // Remove the echo statement to suppress the message

// Select the database
$conn->select_db($dbname);

// Create voters table (if not exists)
$sql = "CREATE TABLE IF NOT EXISTS voters (
    voterID VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    fatherName VARCHAR(100) NOT NULL,
    motherName VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    aadhar VARCHAR(20) NOT NULL UNIQUE,
    address TEXT NOT NULL,
    pincode VARCHAR(10) NOT NULL,
    aadharFile VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    PRIMARY KEY (voterID)
)";
$conn->query($sql);

// Create votes table (if not exists)
$sql = "CREATE TABLE IF NOT EXISTS votes (
    voteID INT AUTO_INCREMENT PRIMARY KEY,
    voterID VARCHAR(20) NOT NULL,
    party VARCHAR(50) NOT NULL,
    voteTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (voterID) REFERENCES voters(voterID)
)";
$conn->query($sql);
?>