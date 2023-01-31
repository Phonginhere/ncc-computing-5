<?php
try {
  // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
  }

  include "config.php";
  
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->execute([$_SESSION['username']]);
  $result = $stmt->get_result();

  $user = $result->fetch_assoc();

  $sqlwep = "SELECT * FROM work_experence WHERE we_id = ?";
  $stmtwep = $mysqli->prepare($sqlwep);
  if(isset($_GET["we_id"])){
    $_SESSION["we_id"] = $_GET["we_id"];
    $stmtwep->execute([$_GET["we_id"]]);
  }else if($_SESSION["we_id"] != null){
    $stmtwep->execute([$_SESSION["we_id"]]);
  }
  
  $result_we = $stmtwep->get_result();

  $w_ep = $result_we->fetch_assoc();

  if ($w_ep["user_id"] != $user["id"]) {

    header("Location: work_exp.php?error=You don't have permission to edit other data");
  } else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Edit work experience data

      $we_id = $_SESSION["we_id"];
      if (isset($_SESSION['username'])) {

        if (
          isset($_POST['id_user']) || isset($_POST['info']) || isset($_POST['dtstarted'])
          || isset($_POST['place']) || isset($_POST['p_name'])) {

          $id_user = $_POST['id_user'];

          //Validate position name

          if (empty(trim($_POST["p_name"]))) {
            $p_name = trim($w_ep['we_position_name']);
          } else
          if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["p_name"]))) {
            $pos_name_err = "Position name can only contain letters, comma, and space";
          } elseif (strlen(trim($_POST["p_name"])) > 60 && strlen(trim($_POST["p_name"])) < 2) {
            $pos_name_err = "Position name: Maximum length is 60, minimum length is 2.";
          } else {
            $p_name = trim($_POST["p_name"]);
          }


          //Validate place name 
          if (empty(trim($_POST["place"]))) {
            $place = trim($w_ep['we_place']);
          } else
          if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["place"]))) {
            $place_err = "place can only contain letters, numbers, comma, and space.";
          } elseif (strlen(trim($_POST["place"])) > 60 && strlen(trim($_POST["place"])) < 2) {
            $place_err = "Place: Maximum length is 60, minimum length is 2.";
          } else {
            $place = trim($_POST["place"]);
          }


          //Validate Date started 
          if (empty(trim($_POST["dtstarted"]))) {
            $dtstarted = trim($w_ep['we_date_started']);
          } else {
            $dtstarted = trim($_POST["dtstarted"]);
          }

          //Validate Date ended 

          if ($_POST['onoroff_cdate'] == "current") {
            $dtended = NULL;
          } elseif ($_POST['onoroff_cdate'] == "locked") {
            $dtended = trim($w_ep['we_date_ended']);
          } else {
            $dtended = $_POST['dtended'];

            //Validate Date ended 
            if (empty(trim($_POST["dtended"]))) {
              //  $dtended_error = "Date started is required.";
              $dtended = trim($w_ep['we_date_ended']);
            } elseif (($dtstarted > $dtended)) {
              $dtended_error = "the ended date is after the started date.";

            } else {
              $dtended = trim($_POST["dtended"]);
            }
          }

          //Validate info name 
          if (empty(trim($_POST["info"]))) {
            $info = trim($w_ep['we_information']);
          } else
          if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["info"]))) {
            $info_err = "info can only contain letters, numbers, comma, and space.";
          } elseif (strlen(trim($_POST["info"])) > 150 && strlen(trim($_POST["info"])) < 4) {
            $info_err = "info: Maximum length is 150, minimum length is 4.";
          } else {
            $info = trim($_POST["info"]);
          }

          // Check input errors before updating in database
          if (empty($info_err) && empty($dtended_error) && empty($dtstarted_error) && empty($place_err) && empty($pos_name_err)) {
            // Prepare an update  statement
            $sql = "UPDATE work_experence SET we_position_name=?, we_place=?, we_date_started=?, 
            we_date_ended=?, we_information=? where we_id = ?";

            if ($stmt = $mysqli->prepare($sql)) {
              // Bind variables to the prepared statement as parameters
              $stmt->bind_param("ssssss", $param_p_name, $param_place, $param_dtstarted, $dtended, $param_info, $we_id);

              // Set parameters
              $param_id_user = $id_user;
              $param_p_name = $p_name;
              $param_place = $place;
              $param_dtstarted = $dtstarted;
              $param_info = $info;


              // Attempt to execute the prepared statement
              if ($stmt->execute()) {
                // Redirect to  work experience table page
                //$success = "Your work experience info has been updated successfully";
                unset($_SESSION["we_id"]);
                header("Location: work_exp.php?success=Your work experience info has been updated successfully");
              } else {
                echo "Oops! Something went wrong. Please try again later.";
              }

              // Close statement
              $stmt->close();
            }
          }

          // Close connection
          $mysqli->close();
        } else {
          header("Location: update_work_exp.php?error=error");
          exit;
        }
      } else {
        header("Location: login.php");
        exit;
      }
    }
  }
} catch (Exception $e) {
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
  <link rel="stylesheet" href="./css/dashboard.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript">
    function Checkradiobutton() {
      if (document.getElementById('locked').checked) {
        document.getElementById('dended').disabled = true;
      } else if (document.getElementById('current').checked) {
        document.getElementById('dended').disabled = true;
      } else {
        document.getElementById('dended').disabled = false;
      }
    }
  </script>
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
  <meta charset=utf-8 />
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Design CV</span>
    </div>
    <?php if ($user['role'] == 1) {
    ?>
      <ul class="nav-links">
        <li>
          <a href="./index.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./skill.php">
            <i class='bx bx-box'></i>
            <span class="links_name">Skill</span>
          </a>
        </li>
        <li>
          <a href="./language.php">
            <i class='bx bx-box'></i>
            <span class="links_name">Language</span>
          </a>
        </li>
        <li>
          <a href="#" class="active">
            <i class='bx bx-list-ul'></i>
            <span class="links_name">Work experience</span>
          </a>
        </li>
        <li>
          <a href="./education.php">
            <i class='bx bx-pie-chart-alt-2'></i>
            <span class="links_name">Education</span>
          </a>
        </li>
        <li>
          <a href="./profile_page.php">
            <i class='bx bx-user'></i>
            <span class="links_name">Profile</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog'></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    <?php } ?>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <!-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div> -->
      <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name">Hello <?php echo $_SESSION['username']; ?></span>
      </div>
    </nav>

    <div class="home-content">
      <?php
      $db = mysqli_connect('localhost', 'root', '', 'demo');
      // if (isset($_SESSION['username'])) {
      include 'user.php';

      $user = getUserByUserName($_SESSION['username'], $db);

      if ($user) { ?>

        <div class="d-flex justify-content-center align-items-center vh-100">

          <form class="shadow w-450 p-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" style="width: 50%;">

            <h4 class="display-4  fs-1">Edit Profile</h4><br>
            <!-- error -->
            <?php if (isset($_GET['error'])) { ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
            <?php } ?>

            <!-- success -->
            <?php if (isset($success)) { ?>
              <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              </div>
            <?php } ?>
            <div class="mb-3">
              <label class="form-label">Position name</label>
              <input type="text" class="form-control" name="p_name" value="<?php echo $w_ep["we_position_name"] ?>" placeholder="Input Position name here....." required>
              <?php if (isset($em)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $em; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <div class="mb-3">
              <label class="form-label">Place</label>
              <input type="text" class="form-control" name="place" placeholder="Input Place here....." value="<?php echo $w_ep["we_place"] ?>" required>
              <?php if (isset($em)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $em; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>


            <div class="mb-3">
              <label class="form-label">Date started</label>
              <input type="date" class="form-control" name="dtstarted" value="<?php echo $w_ep["we_date_started"] ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Date ended</label>
              <input type="date" class="form-control" name="dtended" value="<?php echo $w_ep["we_date_ended"] ?>" id="dended" required disabled>
              <input class="form-label" name="onoroff_cdate" value="locked" type="radio" id="locked" onclick="Checkradiobutton()" checked>Locked
              <input class="form-label" name="onoroff_cdate" value="current" type="radio" id="current" onclick="Checkradiobutton()">Current
              <input class="form-label" name="onoroff_cdate" value="spec_date" type="radio" id="spec_date" onclick="Checkradiobutton()">Specific date<br>
              <?php if (isset($em)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $em; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <div class="mb-3">
              <label class="form-label">Information</label>
              <input type="text" class="form-control" name="info" placeholder="Input Information here....." value="<?php echo $w_ep["we_information"] ?>" required>
              <?php if (isset($em)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $em; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <div class="mb-3" style="display: none;">
              <label class="form-label">User Id</label>
              <input type="hidden" class="form-control" value="<?= $user['id'] ?>" name="id_user">
            </div>

            <button type="submit" class="btn btn-primary" id="btnSubmit">Edit</button>
            <a style="float: right" href="./work_exp.php" class="btn btn-warning" id="addmore">
              <i class="fa fa-fw fa-arrow-left"></i>Back</a>
          </form>
        </div>
      <?php
      }
      // else{ 
      //     header("Location: profile_page.php");
      //     exit;

      // } 
      ?>
    </div>
    </div>
    </div>
  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  </script>

</body>

</html>
<!-- <//?php }else {
	header("Location: login.php");
	exit;
} ?> -->