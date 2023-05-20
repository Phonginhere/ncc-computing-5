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
    <!-- Carousel -->
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
                <img src="./img/background_index.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
                <div class="centered_title">
                    <h1>Welcome to WonderHall</h1>
                </div>
                <div class="centered_desc">
                    <h3>Explore the beauty of untouched landscapes</h3>
                  
                </div>
                <div class="centered_button"><a href="./information.php" target="_blank">Open Link</a></div>
            </div>
            <div class="carousel-item">
            <img src="./img/carousel1.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
                <div class="centered_title">
                    <h1>Perfect Choices</h1>
                </div>
                <div class="centered_desc">
                    <h3>Discover hidden gems, dive into breathtaking waters</h3>
                </div>
                <div class="centered_button"><a href="./availability.php" target="_blank">Open Link</a></div>
            </div>
            <div class="carousel-item">
            <img src="./img/carousel2.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
                <div class="centered_title">
                    <h1>Beautiful Sight</h1>
                </div>
                <div class="centered_desc">
                    <h3>Explore the beauty of untouched landscapes</h3>
                </div>
                <div class="centered_button"><a href="./availability.php" target="_blank">Open Link</a></div>
            </div>
            <div class="carousel-item">
            <img src="./img/carousel3.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
                <div class="centered_title">
                    <h1>Exciting Experience</h1>
                </div>
                <div class="centered_desc">
                    <h3>Start your journey today!</h3>
                </div>
                <div class="centered_button"><a href="./contact.php" target="_blank">Open Link</a></div>
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
                <h2>67 wild camping, swimming, scenic nature sites</h2>
                <h5>Nantcol Waterfalls</h5>
                <h6 class="text-info">Nantcol Waterfalls</h6>
                <img src="./img/nantcol-waterfalls.jpg" alt="" class="fakeimg">
                <ul class="list-group cProductsList">
                    <li class="d-flex"><button> <a class="nav-link" href="#">Features</a></button>
                        <button> <a class="nav-link" href="#">All-time</a></button>
                    </li>
                </ul>
                <p>Camping, touring and glamping in lovely Snowdonia with a fun river to swim and fish in, great for walkers.</p>
                <ul class="list-group cProductsList">
                    <li class="d-flex"><img src="./img/nantcol-waterfalls.jpg" alt="" style="width:45px; border-radius: 50%;">
                    <img src="./img/nantcol-waterfalls.jpg" alt="" style="width:45px; border-radius: 50%;">
                    </li>
                </ul>
                <h5>Dong Mo Discovery</h5>
                <h6 class="text-info">Dong Mo Discovery</h6>
                <img src="./img/DongMoDiscovery.jpg" alt="" class="fakeimg">
                <ul class="list-group cProductsList">
                    <li class="d-flex"><button> <a class="nav-link" href="#">Features</a></button>
                        <button> <a class="nav-link" href="#">All-time</a></button>
                    </li>
                </ul>
                <p>For families with children, Dong Mo Discovery inside the Vietnam Ethnic Culture and Tourism Village in Son Tay Commune, around one hour from Hanoi center, is an ideal choice. The camping spot is a longan garden next to Dong Mo Lake, which allows campers to try their hand at water sports.</p>
                <ul class="list-group cProductsList">
                    <li class="d-flex"><img src="./img/DongMoDiscovery.jpg" alt="" style="width:45px; border-radius: 50%;">
                    <img src="./img/DongMoDiscovery2.jpg" alt="" style="width:45px; border-radius: 50%;">
                    </li>
                </ul>
                <h3 class="mt-4">Some Links</h3>
                <p>Didn't find your match? Come check through these sites!</p>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="https://www.hipcamp.com/journal/camping-wild-swimming-tips-tricks-where-to-pitch">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://vietnamdiscovery.com/top-vietnam/camping-in-vietnam/">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://e.vnexpress.net/photo/places/6-camping-destinations-near-hanoi-amid-scenic-nature-4388282.html">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                    <li class="nav-item">
                    <p>Number of views: <?php echo $views; ?></p> 
                    </li>
                </ul>
                <hr class="d-sm-none">
            </div>
            <div class="col-sm-8">
                <center>
                    <h2>Direction Map</h2>
                </center>
                <iframe src="https://www.google.com/maps/d/embed?mid=16xO6zIWvp8Ac0pMtdnmnkc6EYBu4xWk&ehbc=2E312F" width="100%" height="480"></iframe>
    
            </div>
        </div>
    </div>
   
    
    <?php
    include_once('./footer.php');
    ?>

</body>

</html>