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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = (int)$_POST["language_id"];
        $update = $mysqli->prepare("DELETE FROM language WHERE language_id = ?");
        $update->bind_param('i', $id);
        $update->execute();
        header("Location: language.php?success=Your language info has been deleted successfully");
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
                    <a href="#" class="active">
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
            include 'user.php';

            $user = getUserByUserName($_SESSION['username'], $db);

            if ($user) { ?>

                <div class="d-flex justify-content-center align-items-center vh-100">

                    <div class="container">
                        <h1 class="text-center">The work experience table below.</h1>
                        <hr>
                        <!-- success -->
                        <?php if (isset($_GET["success"])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_GET["success"]; ?>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                        <?php } ?>
                        <script>

                        </script>
                        <div id="msg"></div>
                        <table class="table table-bordered table-striped" id="sortable">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Progress</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tb">
                                <?php

                                $sql = "SELECT l.language_id, l.language_name, l.language_progress 
                FROM language as l
                left join users as u    
                on u.id = l.user_id 
                where username = ? 
                ORDER BY language_name ASC ";

                                $stmt = $mysqli->prepare($sql);
                                $stmt->execute([$_SESSION['username']]);
                                $result_we = $stmt->get_result();

                                if ($result_we->num_rows > 0) {
                                    while ($val  =   $result_we->fetch_assoc()) { ?>
                                        <tr>
                                            <td align="center"><?php echo $val['language_name']; ?></td>
                                            <td align="center"><?php echo $val['language_progress']; ?></td>
                                            <td class="text-center">
                                                <a id="editdata" class="btn btn-primary btn-sm rounded-0 py-0 edit_data noneditable" href="update_language.php?language_id=<?php echo $val['language_id'] ?>">Edit</a>
                                                <?php $value = $val['language_id'];
                                                echo $val['language_id']; ?>
                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><input type="hidden" name="language_id" value="<?php echo $value ?>">
                                                    <input class="btn btn-danger btn-sm rounded-0 py-0 delete_data noneditable" id="deletedata" type="submit" value="Delete">
                                                </form>
                                                <!-- <a href="javascript:;" class="btn btn-danger btn-sm rounded-0 py-0 delete_data noneditable" id="deletedata">
                          <i class="fa fa-fw fa-plus-circle"></i> Delete</a> -->
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="6" class="bg-light text-center"><strong>No Record(s) Found!</strong></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <a href="./insert_language.php" class="btn btn-success" id="addmore"><i class="fa fa-fw fa-plus-circle"></i> Add More</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>


                    </div> <!--/.container-->


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