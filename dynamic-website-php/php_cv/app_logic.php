<?php 
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();
$errors = [];
$user_id = "";
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'demo');

/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM users WHERE email='$email'";
  $results = mysqli_query($db, $query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));

  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($db, $sql);

    // Send email to user with the token in a link they can click on
    // Start with PHPMailer class
    
    
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "Enter email";
    $mail->Password = "Enter Password token";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    
    $mail->From = "Enter email";
    $mail->FromName = "Team Project";
    
    $mail->addAddress("$email", "Hello User");
    
    $mail->isHTML(true);
    
    $mail->Subject = 'Reset your password on examplesite.com';
  // Set HTML 
  $domain = "localhost:81/php_cv";
  $mail->isHTML(TRUE);
  $mail->Body = "Hi there, click on this <a href=\"http://".$domain."/new_password.php/?token=$token\"\">link</a> to reset your password on our site";
  $mail->AltBody = 'Hi there, we are happy to confirm your booking. Please check the document in the attachment.';
  
    try {
      $_SESSION['token'] = $token;
        $mail->send();
        // $_POST['email'] = $email;
        header("location: pending.php?email=$email");
        
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
  }
}

// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = mysqli_real_escape_string($db, $_POST['new_pass']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_pass_c']);

  // Grab to token that came from the email link
  // echo("null or not: {$_SESSION['token']}");
  // exit();
  $token = $_SESSION['token'];
  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_resets table 
    $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
    $results = mysqli_query($db, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $new_pass = md5($password);
      $sql = "UPDATE users SET password='$new_pass' WHERE email='$email'";
      $results = mysqli_query($db, $sql);
      $sqlrevtoken = "DELETE FROM password_resets WHERE email='$email'";
      $results = mysqli_query($db, $sqlrevtoken);
      header('location: http://localhost:81/php_cv/login.php');
    }
  }
}


?>
