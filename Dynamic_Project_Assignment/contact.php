<!DOCTYPE html>
<html lang="en">

<head>
    <title>Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/contact.css">
    <!-- <style>

  </style> -->
</head>

<body>
    <div class="status">
  <?php echo $notification; ?>
</div>
    <?php include_once('./navbar.php'); ?>

    <div class="container py-5 h-100">
        <section class="mb-4">
            <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you.</p>

            <div class="row">
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control" required>
                                    <label for="name">Your name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="email" name="email" class="form-control" required>
                                    <label for="email">Your email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <input type="text" id="subject" name="subject" class="form-control" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                    <label for="message">Your message</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-md-left">
                            <button class="btn btn-primary" type="submit" name="submit">Send</button>
                        </div>
                        <div class="status"></div>
                    </form>
                </div>
                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <i class="fa fa-phone mt-4 fa-2x"></i>
                            <p>+ 01 234 567 89</p>
                        </li>
                        <li>
                            <i class="fa fa-envelope mt-4 fa-2x"></i>
                            <p>contact@mdbootstrap.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>

    <?php include_once('./footer.php'); ?>

    <?php
  // Initialize the notification variable
  $notification = '';

  // Check if the form is submitted
  if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // TODO: Perform database connection and insertion of the form data
    // Replace the following code with your database connection and insertion logic

    // Example code (replace with your own)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shopdb";

    // Create a new PDO instance
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Prepare and execute the SQL query
      $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':subject', $subject);
      $stmt->bindParam(':message', $message);
      $stmt->execute();

      // Display success notification
      $notification = "Form data has been submitted successfully!";
    } catch (PDOException $e) {
      // Display error notification
      $notification = "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
  }
?>
</body>

</html>