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

$sqlwep = "SELECT * FROM skill WHERE skill_id = ?";
$stmtwep = $mysqli->prepare($sqlwep);
if (isset($_GET["skill_id"])) {
    $_SESSION["skill_id"] = $_GET["skill_id"];
    $stmtwep->execute([$_GET["skill_id"]]);
} else if ($_SESSION["skill_id"] != null) {
    $stmtwep->execute([$_SESSION["skill_id"]]);
}

$result_skill = $stmtwep->get_result();

$skill = $result_skill->fetch_assoc();

if ($skill["user_id"] != $user["id"]) {

    header("Location: skill.php?error=You don't have permission to edit other data");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Edit skill data

        $skill_id = $_SESSION["skill_id"];
        if (isset($_SESSION['username'])) {

            if (
                isset($_POST['skill_name']) || isset($_POST['skill_progress'])
            ) {

                $id_user = $_POST['id_user'];

                //Validate Skill name

                if (empty(trim($_POST["skill_name"]))) {
                    $skill_name = trim($skill['skill_name']);
                } else
                if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["skill_name"]))) {
                    $skill_name_err = "Skill can only contain letters, comma, and space";
                } elseif (strlen(trim($_POST["skill_name"])) > 60 && strlen(trim($_POST["skill_name"])) < 2) {
                    $skill_name_err = "Skill: Maximum length is 60, minimum length is 2.";
                } else {
                    $skill_name = trim($_POST["skill_name"]);
                }

                //Validate skill progress 


                $skill_progress = $_POST['skill_progress'];

                if (empty($_POST["skill_progress"])) {
                    //  $skill_progress_error = "year started is required.";
                    $skill_progress = $skill['skill_progress'];
                } elseif (($skill_progress  > 100 || $skill_progress < 0)) {
                    $skill_progress_err = "the skill progress is betweeen 0 and 100.";
                } else {
                    $skill_progress = $_POST["skill_progress"];
                }


                // Check input errors before updating in database
                if (empty($skill_progress_err) && empty($skill_name_err)) {

                    // Prepare an update  statement
                    $sql = "UPDATE skill SET skill_name=?, skill_progress=? where skill_id = ?";

                    if ($stmt = $mysqli->prepare($sql)) {

                        // Bind variables to the prepared statement as parameters
                        $stmt->bind_param("sss", $param_skill_name, $param_skill_progress, $skill_id);

                        // Set parameters
                        $param_skill_name = $skill_name;
                        $param_skill_progress = $skill_progress;


                        // Attempt to execute the prepared statement
                        if ($stmt->execute()) {
                            // Redirect to  skill table page
                            //$success = "Your skill info has been updated successfully";
                            unset($_SESSION["skill_id"]);
                            header("Location: skill.php?success=Your skill info info has been updated successfully");
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
                header("Location: update_skill.php?error=error");
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
                    <a href="#" class="active">
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
                    <a href="./work_exp.php">
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

                        <h4 class="display-4  fs-1">Edit Skill</h4><br>
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
                            <label class="form-label">SKill</label>
                            <input type="text" class="form-control" name="skill_name" value="<?php echo $skill["skill_name"] ?>" placeholder="Input Skill here....." required>
                            <?php if (isset($skill_name_err)) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $skill_name_err; ?>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Skill progress</label>
                            <input type="number" class="form-control" name="skill_progress" value="<?php echo $skill["skill_progress"] ?>" required disabled>
                            <?php if (isset($skill_progress_err)) { ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo $skill_progress_err; ?>
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="mb-3" style="display: none;">
                            <label class="form-label">User Id</label>
                            <input type="hidden" class="form-control" value="<?= $user['id'] ?>" name="id_user">
                        </div>

                        <button type="submit" class="btn btn-primary" id="btnSubmit">Edit</button>
                        <a style="float: right" href="./skill.php" class="btn btn-warning" id="addmore">
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