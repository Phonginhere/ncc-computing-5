<link rel="stylesheet" href="./css/Navbarfooter.css">
<script src="./js/navbar.js"></script>

<header id="navbar">
  <nav class="navbar-container container">
    <a href="/" class="home-link">
      <div class="navbar-logo"></div>
      GWSC
    </a>
    <button type="button" class="navbar-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="navbar-menu">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <div id="navbar-menu" class="detached">
      <ul class="navbar-links">
        <li class="navbar-item"><a class="navbar-link active" href="./index.php">Home</a></li>
        <li class="navbar-item"><a class="navbar-link" href="./information.php">Information</a></li>
        <li class="navbar-item"><a class="navbar-link" href="./availability.php">Availability</a></li>
        <li class="navbar-item"><a class="navbar-link" href="./reviewspage.php">Reviews</a></li>
        <li class="navbar-item"><a class="navbar-link" href="./contact.php">Contact</a></li>

        <?php
        // Check if user is logged in
        session_start();
        // Retrieve the session values from the URL parameters
        // $userID = $_GET['user_id'];
        // $userEmail = $_GET['user_email'];
        // echo isset($_SESSION['user_id']);
        // echo isset($_SESSION['user_email']);
        // $sessionID = $_GET['user_id'];
        // echo $sessionID;
        // exit();
        if (isset($_GET['user_id']) && isset($_GET['user_email'])) {
          // User is logged in, display logout link
          echo '<li class="navbar-item"><a class="navbar-link" href="./logout.php">Logout</a></li>';
        } else {
          // User is not logged in, display login and register links
          echo '<li class="navbar-item"><a class="navbar-link" href="./login.php">Login</a></li>';
          echo '<li class="navbar-item"><a class="navbar-link" href="./register.php">Register</a></li>';
        }
        ?>

      </ul>
    </div>
  </nav>
</header>
<body>
<!-- Your page content here -->
</body>
