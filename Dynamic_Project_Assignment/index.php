<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Increment the number of views
$sql = "UPDATE views_counter SET views = views + 1 WHERE id = 1";
$conn->query($sql);

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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap 5 Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/index.css">

<body>
<?php include_once('./navbar.php'); ?>

<div id="demo" class="carousel slide" data-bs-ride="carousel">

<!-- Indicators/dots -->
<div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
</div>

<!-- The slideshow/carousel -->
<div class="carousel-inner">
    <div class="carousel-item active">
        <img src="./img/site-a.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
        <div class="carousel-caption">
        <h1>Welcome to WonderHall</h1>
        <h3>Discover the wonders of nature</h3>
        <a href="./information.php" target="_blank">Explore More</a>
      </div>
    </div>
    <div class="carousel-item">
    <img src="./img/carousel1.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
    <div class="carousel-caption">
        <h1>Unforgettable Experiences</h1>
        <h3>Immerse yourself in breathtaking landscapes</h3>
        <a href="./availability.php" target="_blank">Check Availability</a>
      </div>
    </div>
    <div class="carousel-item">
    <img src="./img/carousel2.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
    <div class="carousel-caption">
        <h1>Escape to Tranquility</h1>
        <h3>Relax and unwind in serene surroundings</h3>
        <a href="./availability.php" target="_blank">Book Now</a>
      </div>
    </div>
    <div class="carousel-item">
    <img src="./img/carousel3.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
    <div class="carousel-caption">
        <h1>Your Adventure Awaits</h1>
        <h3>Embark on an exciting journey</h3>
        <a href="./contact.php" target="_blank">Contact Us</a>
      </div>
    </div>
</div>

<!-- Left and right controls/icons -->
<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
</button>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4">
            <h2>Explore Nature</h2>
            <h5>Nantcol Waterfalls</h5>
            <h6 class="text-info">Experience the Magic</h6>
            <img src="./img/site-f.jpg" alt="Nantcol Waterfalls" class="fakeimg">
            <p>Immerse yourself in the beauty of Snowdonia with camping, touring, and glamping options. Enjoy a fun river for swimming and fishing, making it a perfect spot for walkers and nature enthusiasts.</p>
           
            <h5>Dong Mo Discovery</h5>
            <h6 class="text-info">Discover the Hidden Gem</h6>
            <img src="./img/site-b.jpg" alt="Dong Mo Discovery" class="fakeimg">
            <p>Experience the tranquility of Dong Mo Lake surrounded by breathtaking landscapes and enjoy a range of activities such as kayaking, fishing, and camping.</p>
            
        </div>
        <div class="col-sm-8">
            <h2>About Us</h2>
                <p>WonderHall is a leading provider of nature experiences and outdoor adventures. We offer a wide range of activities and accommodations to suit every traveler's preferences.</p>
                <p>Our mission is to provide unforgettable experiences in the most beautiful natural settings. Whether you're seeking tranquility, adventure, or an opportunity to connect with nature, WonderHall has something for you.</p>
            <h2>Contact Us</h2>
                <p>If you have any questions or inquiries, please feel free to contact us. Our friendly team is ready to assist you.</p>
        <div class="map-container" style="height: 400px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.3092565253324!2d-122.08400318488861!3d37.4219997798255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f80b55df8e4eb%3A0xf6a13a57d2e7a3c4!2sGolden%20Gate%20Bridge!5e0!3m2!1sen!2sus!4v1625649254702!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 100%;"></iframe>
        </div>
    </div>

    </div>
</div>


<?php include_once('./footer.php'); ?>
</body>

</html>