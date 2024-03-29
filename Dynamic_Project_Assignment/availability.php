<?php
require_once 'connectionCounter.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Availability Page - Wild Camping, Swimming, Scenic Nature</title>
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif;
      color: white; /* Changed text color to white */
    }

    h1 {
      text-align: center;
      margin-top: 20px;
      color: #333;
    }

    .site-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin: 20px auto;
    }

    .site {
      width: 300px;
      margin: 10px;
      padding: 20px;
      background-color: #777; /* Changed background color to grey */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: center;
      color: white; /* Changed text color to white */
    }

    .site img {
      max-width: 100%;
      height: auto;
      margin-bottom: 10px;
    }

    .site h2 {
      margin-bottom: 10px;
      color: #333;
    }

    .site p {
      margin: 0;
      color: white;
    }

    .site .availability {
      margin-top: 10px;
      font-weight: bold;
      color: #4CAF50;
    }

    .site .booking-button {
      margin-top: 10px;
      background-color: red;
      color: white;
      padding: 8px 16px;
      border: none;
      cursor: pointer;
      font-size: 14px;
    }

    .site .booking-button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }

    /* Pagination styles */
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .pagination a {
      margin: 0 5px;
      padding: 5px 10px;
      background-color: #f3f3f3;
      text-decoration: none;
      color: #333;
    }

    .pagination a.active {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <?php include_once('./navbar.php'); ?>

  <h1>Available Camping and Swimming Sites in Vietnam</h1>

  <div class="site-container">
    <?php
    // PHP code
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

    // Pagination configuration
    $resultsPerPage = 12; // Maximum number of products per page
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the URL query parameter
    $offset = ($currentPage - 1) * $resultsPerPage; // Calculate the offset

    // Retrieve data from the database based on pagination
    $sql = "SELECT * FROM camping_sites LIMIT $resultsPerPage OFFSET $offset";
    $result = $conn->query($sql);

    // Loop through the data and generate HTML elements
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='site'>
                <img src='" . $row["image"] . "' alt='" . $row["name"] . "'>
                <h2>" . $row["name"] . "</h2>
                <p><strong>Location:</strong> " . $row["location"] . "</p>
                <p><strong>Description:</strong></p>
                <p>" . $row["description"] . "</p>
                <p><strong>Availability:</strong> <span class='availability'>" . $row["availability"] . "</span></p>
                <button class='booking-button' onclick='handleBookingClick(this)' data-id='" . $row["id"] . "'>Book Now</button>
              </div>";
      }
    } else {
      echo "No sites available.";
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>

  <!-- Pagination links -->
  <div class="pagination">
    <?php
    // PHP code
    // Database connection configuration
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Get the total number of products
    $sqlCount = "SELECT COUNT(*) AS total FROM camping_sites";
    $resultCount = $conn->query($sqlCount);
    $totalCount = $resultCount->fetch_assoc()["total"];

    // Calculate the total number of pages
    $totalPages = ceil($totalCount / $resultsPerPage);

    // Generate the pagination links
    for ($i = 1; $i <= $totalPages; $i++) {
      $activeClass = ($i == $currentPage) ? "active" : "";
      echo "<a href='availability.php?page=$i' class='$activeClass'>$i</a>";
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>

  <script>
    // JavaScript code
    // Function to handle the booking button click
    function handleBookingClick(button) {
      var siteElement = button.parentNode;
      var availabilityElement = siteElement.querySelector(".availability");
      var availability = parseInt(availabilityElement.textContent);

      if (availability > 0) {
        availability--;
        availabilityElement.textContent = availability;

        if (availability === 0) {
          button.textContent = "Fully Booked";
          button.disabled = true;
        }

        // Update availability in the database using an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update-availability.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("id=" + button.dataset.id + "&availability=" + availability);
      }
    }
  </script>

  <?php include_once('./footer.php'); ?>
</body>
</html>
