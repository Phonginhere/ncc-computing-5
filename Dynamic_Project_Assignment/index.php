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
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/background_index.jpg" alt="Los Angeles" class="d-block" width="100%" height="500">
                <div class="centered_title">
                    <h1>Main title</h1>
                </div>
                <div class="centered_desc">
                    <h3>Description</h3>
                </div>
                <div class="centered_button"><a href="#" target="_blank">Open Link</a></div>
            </div>
            <div class="carousel-item">
                <img src="chicago.jpg" alt="Chicago" class="d-block" width="100%" height="500">
            </div>
            <div class="carousel-item">
                <img src="ny.jpg" alt="New York" class="d-block" width="100%" height="500">
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

    <!-- <div class="container-fluid mt-3">
        <h3>67 wild camping, swimming, scenic nature sites</h3>
        <p>The following example shows how to create a basic carousel with indicators and controls.</p>
    </div> -->
    <!-- <div class="p-5 bg-primary text-white text-center">
  <h1>My First Bootstrap 5 Page</h1>
  <p>Resize this responsive page to see the effect!</p>
</div> -->



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
                <h3 class="mt-4">Some Links</h3>
                <p>Lorem ipsum dolor sit ame.</p>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <hr class="d-sm-none">
            </div>
            <div class="col-sm-8">
                <center>
                    <h2>Direction Map</h2>
                </center>
                <iframe src="https://www.google.com/maps/d/embed?mid=16xO6zIWvp8Ac0pMtdnmnkc6EYBu4xWk&ehbc=2E312F" width="100%" height="480"></iframe>
                <!-- <h5>Title description, Dec 7, 2020</h5>
                <div class="fakeimg">Fake Image</div>
                <p>Some text..</p>
                <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco.</p>

                <h2 class="mt-5">TITLE HEADING</h2>
                <h5>Title description, Sep 2, 2020</h5>
                <div class="fakeimg">Fake Image</div>
                <p>Some text..</p>
                <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco.</p> -->
            </div>
        </div>
    </div>

    <?php
    include_once('./footer.php');
    ?>

</body>

</html>