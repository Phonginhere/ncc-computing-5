<?php
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
$username = $_SESSION['username'];
$stmt->execute([$username]);
$result = $stmt->get_result();

$user = $result->fetch_assoc();
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
          <a href="#" class="active">
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
      <?php if ($user['role'] == 1) {
      ?>
        <section class="main">
          <div class="container">
            <div class="row">
              <div class="col-4">
                <div class="col-left-inner">
                  <div class="avatar-wrap">
                    <div class="avatar">
                      <img src="./assets/<?= $user['img']  ?>" alt="avatar" />
                    </div>
                    <div class="name">
                      <h2><?php echo $user['fullname'] ?></h2>
                    </div>
                  </div>
                  <div class="contact-skill-wrap">
                    <div class="contact-wrap">
                      <ul>
                        <li>
                          <i class="fa-suitcase fa"></i>
                          <span><?php echo $user['job']; ?></span>
                        </li>
                        <li>
                          <i class="fa-home fa"></i>
                          <span><?php echo $user['address']; ?></span>
                        </li>
                        <li>
                          <i class="fas fa-envelope"></i>
                          <span><?php echo $user['email']; ?></span>
                        </li>
                        <li>
                          <i class="fa-phone fa"></i>
                          <span><?php echo $user['phone']; ?></span>
                        </li>
                    </div>
                    <!-- skills -->

                    <?php

                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                    $mysqli->query("select COUNT(*) from `skill` where user_id = " . $user["id"] . "");

                    $sql = "SELECT * FROM skill where user_id = " . $user["id"] . " ORDER BY skill_name ASC ";


                    $mysqli->multi_query($sql);

                    // $result = mysqli_multi_query($link, $query);


                    do {
                      if ($result = $mysqli->store_result()) {
                        $rowCount = mysqli_num_rows($result);
                        // echo "Number of rows: " . $rowCount;

                        if ($rowCount > 0) {
                    ?>
                          <div class="skill-wrap first">
                            <h3>
                              <i class="fas fa-asterisk"></i>
                              <b>Skills</b>
                            </h3>
                            <div class="skills">
                              <?php while ($val  =   $result->fetch_assoc()) { ?>
                                <div class="item">
                                  <p><?php echo $val['skill_name']; ?></p>
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $val['skill_progress']; ?>%" aria-valuenow="<?php echo $val['skill_progress']; ?>" aria-valuemin="0" aria-valuemax="100">
                                      <div class="label"><?php echo $val['skill_progress']; ?>%</div>
                                    </div>
                                  </div>
                                </div>
                              <?php
                              } ?>
                            </div>
                          </div>
                        <?php
                        } else {
                        ?>
                          <div class="skill-wrap first">
                            <h3>
                              <i class="fas fa-asterisk"></i>
                              <b>Skills</b>
                            </h3>
                            <div class="skills">
                              <div class="item">
                                <p>There's nothing to display here</p>
                              </div>
                            </div>
                          </div>
                    <?php
                        }
                      }
                    } while ($mysqli->next_result());
                    ?>

                    <!--Language-->
                    <?php

                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                    $mysqli->query("select COUNT(*) from `language` where user_id = " . $user["id"] . "");

                    $sql = "SELECT * FROM language where user_id = " . $user["id"] . " ORDER BY language_name ASC ";


                    $mysqli->multi_query($sql);

                    // $result = mysqli_multi_query($link, $query);


                    do {
                      if ($result = $mysqli->store_result()) {
                        $rowCount = mysqli_num_rows($result);
                        // echo "Number of rows: " . $rowCount;

                        if ($rowCount > 0) {
                    ?>
                          <div class="skill-wrap second">
                            <h3>
                              <i class="fas fa-globe"></i>
                              <b>Language</b>
                            </h3>
                            <div class="skills">
                              <?php while ($val  =   $result->fetch_assoc()) { ?>
                                <div class="item">
                                  <p><?php echo $val['language_name']; ?></p>
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $val['language_progress']; ?>%" aria-valuenow="<?php echo $val['language_progress']; ?>" aria-valuemin="0" aria-valuemax="100">

                                    </div>
                                  </div>
                                </div>
                              <?php
                              } ?>
                            </div>
                          </div>
                        <?php
                        } else {
                        ?>
                          <div class="skill-wrap second">
                            <h3>
                              <i class="fas fa-globe"></i>
                              <b>Languages</b>
                            </h3>
                            <div class="skills">
                              <div class="item">
                                <p>There's nothing to display here</p>
                              </div>
                            </div>
                          </div>
                    <?php
                        }
                      }
                    } while ($mysqli->next_result());
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-8">
                <?php

                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                $mysqli->query("select COUNT(*) from `work_experence` where user_id = " . $user["id"] . "");

                $sql = "SELECT * FROM work_experence where user_id = " . $user["id"] . " ORDER BY we_date_ended ASC ";


                $mysqli->multi_query($sql);

                // $result = mysqli_multi_query($link, $query);


                do {
                  if ($result = $mysqli->store_result()) {
                    $rowCount = mysqli_num_rows($result);
                    // echo "Number of rows: " . $rowCount;

                    if ($rowCount > 0) {
                ?>
                      <div class="col-right-inner">
                        <h2 class="title"><i class="fas fa-suitcase"></i> <span>Work Experience</span></h2>
                        <div class="experience-wrap">
                          <?php while ($val  =   $result->fetch_assoc()) { ?>
                            <div class="item">
                              <h3><?php echo $val['we_position_name']; ?> / <?php echo $val['we_place']; ?></h3>
                              <div class="date"><i class="fa fa-calendar"></i> <?php echo date($val['we_date_started']); ?> -
                                <span class="current"><?php echo $mod = $val['we_date_ended'] == NULL ? "current" : date($val['we_date_ended']); ?>
                                </span>
                              </div>
                              <p><?php echo $val['we_information']; ?></p>
                            </div>
                          <?php
                          } ?>
                        </div>
                      </div>
                    <?php
                    } else {
                    ?>
                      <div class="col-right-inner">
                        <h2 class="title"><i class="fas fa-suitcase"></i> <span>Work Experience</span></h2>
                        <div class="experience-wrap">
                          <p>There's nothing to display here</p>
                        </div>
                      </div>
                <?php
                    }
                    // var_dump($result->fetch_all(MYSQLI_ASSOC));
                    // $result->free();
                  }
                } while ($mysqli->next_result());
                ?>

                <?php

                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                $mysqli->query("select COUNT(*) from `education` where user_id = " . $user["id"] . "");

                $sql = "SELECT * FROM education where user_id = " . $user["id"] . " ORDER BY edu_year_ended ASC ";


                $mysqli->multi_query($sql);

                // $result = mysqli_multi_query($link, $query);


                do {
                  if ($result = $mysqli->store_result()) {
                    $rowCount = mysqli_num_rows($result);
                    // echo "Number of rows: " . $rowCount;

                    if ($rowCount > 0) {
                ?>
                      <div class="col-right-inner">
                        <h2 class="title"><i class="fas fa-certificate"></i> <span>Education</span></h2>
                        <div class="experience-wrap">
                          <?php while ($val  =   $result->fetch_assoc()) { ?>
                            <div class="item">
                              <h3><?php echo $val['edu_major']; ?> / <?php echo $val['edu_school']; ?></h3>
                              <div class="date"><i class="fa fa-calendar"></i> <?php echo date($val['edu_year_started']); ?> -
                                <span class="current"><?php echo $mod = $val['edu_year_ended'] == NULL ? "current" : date($val['edu_year_ended']); ?>
                                </span>
                              </div>
                              <p><?php echo $val['edu_info']; ?></p>
                            </div>
                          <?php
                          } ?>
                        </div>
                      </div>
                    <?php
                    } else {
                    ?>
                      <div class="col-right-inner">
                        <h2 class="title"><i class="fas fa-suitcase"></i> <span>Education</span></h2>
                        <div class="experience-wrap">
                          <p>There's nothing to display here</p>
                        </div>
                      </div>
                <?php
                    }
                    // var_dump($result->fetch_all(MYSQLI_ASSOC));
                    // $result->free();
                  }
                } while ($mysqli->next_result());
                ?>
              </div>
            </div>
          </div>
        </section>
      <?php } else if ($user['role'] == 2) {
      ?>

      <?php } ?>

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