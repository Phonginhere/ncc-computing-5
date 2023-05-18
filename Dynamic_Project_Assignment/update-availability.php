<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "shopdb";


// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the parameters
$id = $_POST["id"];
$availability = $_POST["availability"];

// Update the availability in the database
$sql = "UPDATE camping_swimming_sites SET availability = '$availability' WHERE id = '$id'";
if ($conn->query($sql) === TRUE) {
  echo "Availability updated successfully.";
} else {
  echo "Error updating availability: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
