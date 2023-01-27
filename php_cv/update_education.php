<?php
// try {
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

$sqlwep = "SELECT * FROM education WHERE edu_id = ?";
$stmtwep = $mysqli->prepare($sqlwep);
if (isset($_GET["edu_id"])) {
    $_SESSION["edu_id"] = $_GET["edu_id"];
    $stmtwep->execute([$_GET["edu_id"]]);
} else if ($_SESSION["edu_id"] != null) {
    $stmtwep->execute([$_SESSION["edu_id"]]);
}

$result_edu = $stmtwep->get_result();

$edu = $result_edu->fetch_assoc();

if ($edu["user_id"] != $user["id"]) {

    header("Location: education.php?error=You don't have permission to edit other data");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Edit education data

        $edu_id = $_SESSION["edu_id"];
        if (isset($_SESSION['username'])) {

            if (
                isset($_POST['id_user']) || isset($_POST['info']) || isset($_POST['ystarted'])
                || isset($_POST['school']) || isset($_POST['p_major'])
            ) {

                $id_user = $_POST['id_user'];

                //Validate Major

                if (empty(trim($_POST["p_major"]))) {
                    $p_major = trim($edu['edu_major']);
                } else
          if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["p_major"]))) {
                    $p_major_err = "Major can only contain letters, comma, and space";
                } elseif (strlen(trim($_POST["p_major"])) > 60 && strlen(trim($_POST["p_major"])) < 2) {
                    $p_major_err = "Major: Maximum length is 60, minimum length is 2.";
                } else {
                    $p_major = trim($_POST["p_major"]);
                }


                //Validate school name 
                if (empty(trim($_POST["school"]))) {
                    $school = trim($edu['edu_school']);
                } else
          if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["school"]))) {
                    $school_err = "school can only contain letters, numbers, comma, and space.";
                } elseif (strlen(trim($_POST["school"])) > 60 && strlen(trim($_POST["school"])) < 2) {
                    $school_err = "school: Maximum length is 60, minimum length is 2.";
                } else {
                    $school = trim($_POST["school"]);
                }


                //Validate Year started 
                if (empty($_POST["ystarted"])) {
                    $ystarted = $edu['edu_year_started'];
                } else {
                    $ystarted = $_POST["ystarted"];
                }

                //Validate Year ended 

                if ($_POST['onoroff_cyear'] == "current") {
                    $yended = NULL;
                } elseif ($_POST['onoroff_cyear'] == "locked") {
                    $yended = $edu['edu_year_ended'];
                } else {
                    $yended = $_POST['yended'];

                    //Validate year ended 
                    if (empty($_POST["yended"])) {
                        //  $yended_error = "year started is required.";
                        $yended = $edu['edu_year_ended'];
                    } elseif (($ystarted > $yended)) {
                        $yended = "the ended year is after the started year.";
                    } else {
                        $yended = $_POST["yended"];
                    }
                }

                //Validate info name 
                if (empty(trim($_POST["info"]))) {
                    $info = trim($edu['edu_info']);
                } else
          if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["info"]))) {
                    $info_err = "info can only contain letters, numbers, comma, and space.";
                } elseif (strlen(trim($_POST["info"])) > 150 && strlen(trim($_POST["info"])) < 4) {
                    $info_err = "info: Maximum length is 150, minimum length is 4.";
                } else {
                    $info = trim($_POST["info"]);
                }

                // Check input errors before updating in database
                if (empty($info_err) && empty($yended_error) && empty($ystarted_error) && empty($school_err) && empty($p_major_err)) {

                    // Prepare an update  statement
                    $sql = "UPDATE education SET edu_major=?, edu_school=?, edu_year_started=?, edu_year_ended=?, edu_info=? where edu_id = ?";

                    if ($stmt = $mysqli->prepare($sql)) {

                        // Bind variables to the prepared statement as parameters
                        $stmt->bind_param("ssssss", $param_p_major, $param_school, $param_ystarted, $yended, $param_info, $edu_id);

                        // Set parameters
                        $param_p_major = $p_major;
                        $param_school = $school;
                        $param_ystarted = $ystarted;
                        $param_info = $info;



                        // Attempt to execute the prepared statement
                        if ($stmt->execute()) {
                            // Redirect to  education table page
                            //$success = "Your education info has been updated successfully";
                            unset($_SESSION["edu_id"]);
                            header("Location: education.php?success=Your education info info has been updated successfully");
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
                header("Location: update_education.php?error=error");
                exit;
            }
        } else {
            header("Location: login.php");
            exit;
        }
    }
}
// } catch (Exception $e) {
// }
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
                document.getElementById('yended').disabled = true;
            } else if (document.getElementById('current').checked) {
                document.getElementById('yended').disabled = true;
            } else {
                document.getElementById('yended').disabled = false;
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
                            <label class="form-label">Major</label>
                            <input type="text" class="form-control" name="p_major" value="<?php echo $edu["edu_major"] ?>" placeholder="Input Major here....." required>
                            <?php if (isset($em)) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $em; ?>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">School</label>
                            <input type="text" class="form-control" name="school" placeholder="Input School here....." value="<?php echo $edu["edu_school"] ?>" required>
                            <?php if (isset($em)) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $em; ?>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            <?php } ?>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Year started</label>
                            <input type="number" class="form-control" name="ystarted" value="<?php echo $edu["edu_year_started"] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Year ended</label>
                            <input type="number" class="form-control" name="yended" value="<?php echo $edu["edu_year_ended"] ?>" id="yended" required disabled>
                            <input class="form-label" name="onoroff_cyear" value="locked" type="radio" id="locked" onclick="Checkradiobutton()" checked>Locked
                            <input class="form-label" name="onoroff_cyear" value="current" type="radio" id="current" onclick="Checkradiobutton()">Current
                            <input class="form-label" name="onoroff_cyear" value="spec_year" type="radio" id="spec_year" onclick="Checkradiobutton()">Specific year<br>
                            <?php if (isset($em)) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $em; ?>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Information</label>
                            <input type="text" class="form-control" name="info" placeholder="Input Information here....." value="<?php echo $edu["edu_info"] ?>" required>
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
                        <a style="float: right" href="./education.php" class="btn btn-warning" id="addmore">
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