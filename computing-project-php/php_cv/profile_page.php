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
    // Edit profile user
    if (isset($_SESSION['username'])) {
      // echo "fwwfwefwee23322323w: ",$_POST['edit_job'];
      //     exit();
      if (
        isset($_POST['edit_password']) || isset($_POST['edit_phone'])
        || isset($_POST['edit_address']) || isset($_POST['edit_job']) || isset($_POST['edit_fname'])
      ) {



        $username = $password = "";
        $password = $_POST['edit_password'];
        $pre_username = $_SESSION['username'];


        $new_phone = $_POST["edit_phone"];
        $new_address = $_POST["edit_address"];
        $new_job = $_POST["edit_job"];
        $new_fname = $_POST["edit_fname"];

        $old_pp = $_POST['old_pp'];




        //Validate phone number
        if (empty(trim($_POST["edit_phone"]))) {
          $phonenum = trim($user['phone']);
        } else
    
    if (!preg_match('/^[0-9]+$/', trim($_POST["edit_phone"]))) {
          $phone_err = "Phone can only contain numbers.";
        } elseif (strlen(trim($_POST["edit_phone"])) != 10) {
          $phone_err = "Phone only has 10 characters in length.";
          // header("Location: profile_page.php?phone_err=Phone only has 10 characters in length");
        } else {
          $phonenum = trim($_POST["edit_phone"]);
        }

        //Validate address 
        if (empty(trim($_POST["edit_address"]))) {
          $address = trim($user['address']);
        } else
    
    if (!preg_match('/^[a-zA-Z0-9, ]+$/', trim($_POST["edit_address"]))) {
          $address_err = "address can only contain letters, numbers, comma, and space.";
        } else {
          $address = trim($_POST["edit_address"]);
        }

        //Validate Job 
        if (empty(trim($_POST["edit_job"]))) {
          $fname = trim($user['job']);
        } else
    if (!preg_match('/^[a-zA-Z0-9 ]+$/', trim($_POST["edit_job"]))) {
          $job_err = "job can only contain letters, numbers, and space.";
        } else {
          $job = trim($_POST["edit_job"]);
        }

        //Validate Full name 
        // echo "co hay ko kia: ", $_POST["edit_fname"], "\n";
        if (empty(trim($_POST["edit_fname"]))) {
          $fname_err = "Please enter a Full Name.";
          // echo "thieu full name : ", $_POST["edit_fname"], "\n";
        } elseif (!preg_match('/^[a-zA-Z ]+$/', trim($_POST["edit_fname"]))) {
          $fname_err = "Full name can only contain letters, and space.";
          // echo "chi chua duoc letter thoi : ", $_POST["edit_fname"], "\n";
        } else {
          $fname = trim($_POST["edit_fname"]);

          // echo "co hay ai biet dc : ", $_POST["edit_fname"], "\n";
        }


        $uppercase = preg_match('@[A-Z]@', trim($_POST["edit_password"]));
        $lowercase = preg_match('@[a-z]@', trim($_POST["edit_password"]));
        $number    = preg_match('@[0-9]@', trim($_POST["edit_password"]));

        // Validate password
        if (empty(trim($_POST["edit_password"]))) {
          $param_password = trim($password);
        } else
  
  if (strlen(trim($_POST["edit_password"])) < 6) {
          $password_err = "Password must have atleast 6 characters.";
        } elseif (!$uppercase || !$lowercase || !$number) {
          $password_err = "Password must contain letters, numbers, and special letter.";
        } else {
          $password = trim($_POST["edit_password"]);

          // Set parameters
          $param_password = trim($_POST["edit_password"]);
        }

        // // Validate confirm password
        // if(empty(trim($_POST["confirm_password"]))){
        //     $confirm_password_err = "Please confirm password.";     
        // } else{
        //     $confirm_password = trim($_POST["confirm_password"]);
        //     if(empty($password_err) && ($password != $confirm_password)){
        //         $confirm_password_err = "Password did not match.";
        //     }
        // }

        //validate image
        // echo "ưefwefwef: ", isset($_FILES['pp']['name']), "hahah: ", empty($_FILES['pp']['name']);
        // exit();
        if (isset($_FILES['pp']['name']) == 1 and empty($_FILES['pp']['name']) == 1) {
          $param_new_img = $new_img_name = $user['img'];
        } else {
          if (isset($_FILES['pp']['name']) and !empty($_FILES['pp']['name'])) {

            $img_name = $_FILES['pp']['name'];
            $tmp_name = $_FILES['pp']['tmp_name'];
            $error = $_FILES['pp']['error'];

            if ($error === 0) {
              $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
              $img_ex_to_lc = strtolower($img_ex);

              $allowed_exs = array('jpg', 'jpeg', 'png');
              if (in_array($img_ex_to_lc, $allowed_exs)) {
                $new_img_name = uniqid($pre_username, true) . '.' . $img_ex_to_lc;
                $img_upload_path = './assets/' . $new_img_name;
                // Delete old profile pic
                $old_pp_des = "./assets/$old_pp";
                if (unlink($old_pp_des)) {
                  // just deleted
                  move_uploaded_file($tmp_name, $img_upload_path);
                } else {
                  // error or already deleted
                  move_uploaded_file($tmp_name, $img_upload_path);
                }

                $param_new_img = $new_img_name;
              }
            } else {
              $param_new_img = $new_img_name = $user['img'];
              $em = "unknown error occurred!";
              //  exit;
            }
          }
        }


        // Check input errors before updating in database
        if (empty($password_err) && empty($fname_err) && empty($job_err) && empty($address_err) && empty($phone_err) && empty($em)) {
          // Prepare an insert statement
          $sql = "UPDATE users SET password=?, phone=?, address=?, job=?, fullname=?, img=? WHERE username=?";

          if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssss", $param_password, $param_phonenum, $address, $param_job, $fname, $param_new_img, $param_pre_username);

            // Set parameters
            $param_password = md5($password); // Creates a password hash
            $param_phonenum = $phonenum;
            // $param_address = $address;
            $param_job = $job;
            // $param_fname = $fname;
            $param_pre_username = $pre_username;
            $param_new_img = $new_img_name;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
              // Redirect to login page
              $success = "Your account has been updated successfully";
              // header("Location: profile_page.php?success=Your account has been updated successfully");
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
        header("Location: profile_page.php?error=error");
        exit;
      }
    } else {
      header("Location: login.php");
      exit;
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
    // $(document).ready(function () {
    //    $("#ConfirmPassword").on('keyup', function(){
    //     var password = $("#Password").val();
    //     var confirmPassword = $("#ConfirmPassword").val();
    //     if (password != confirmPassword)
    //         $("#CheckPasswordMatch").html("Password does not match !").css("color","red");
    //     else
    //         $("#CheckPasswordMatch").html("Password match !").css("color","green");
    //    });
    // });
    $(function() {
      $("#btnSubmit").click(function() {
        var password = $("#Password").val();
        var confirmPassword = $("#ConfirmPassword").val();
        if (password != confirmPassword) {
          alert("Passwords do not match.");
          return false;
        }
        return true;
      });
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result).width(150).height(200);
        };

        reader.readAsDataURL(input.files[0]);
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
          <a href="#" class="active">
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
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" name="edit_fname" value="<?php echo $user['fullname'] ?>">
              <?php if (isset($fname_err)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $fname_err; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <div class="mb-3">
              <label class="form-label">Job - Occupation</label>
              <input type="text" class="form-control" name="edit_job" value="<?php echo $user['job'] ?>">
              <?php if (isset($job_err)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $job_err; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <div class="mb-3">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" name="edit_address" value="<?php echo $user['address'] ?>">
              <?php if (isset($address_err)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $address_err; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input type="text" class="form-control" name="edit_phone" value="<?php echo $user['phone'] ?>">
              <?php if (isset($phone_err)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $phone_err; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="edit_password" id="Password">
              <?php if (isset($password_err)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $password_err; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <div class="mb-3">
              <label class="form-label">Re-type Password again</label>
              <input type="password" class="form-control" name="retypepassword" id="ConfirmPassword">
              <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
            </div>

            <div class="mb-3">
              <label class="form-label">Profile Picture</label>
              <input type="file" class="form-control" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" name="pp">
              <?php
              ?>
              <img src="./assets/<?= $user['img']  ?>" style="width: 270px" id="blah">
              <input type="text" hidden="hidden" name="old_pp" value="<?= $user['img'] ?>">
              <?php if (isset($em)) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?php echo $em; ?>
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
              <?php } ?>
            </div>

            <!-- <input type='file' onchange="readURL(this);" />
        <img id="blah" src="#" alt="your image" /> -->

            <button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
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