<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve the number of views
$sql = "SELECT views FROM views_counter WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $views = $row["views"];
} else {
    $views = 0;
}

$conn->close();
?>