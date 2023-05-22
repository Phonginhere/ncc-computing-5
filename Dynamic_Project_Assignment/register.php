<!DOCTYPE html>
<html lang="en">

<head>
    <title>Website Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/registration.css">
    <!-- <style>

  </style> -->
</head>

<body>
    <?php
    $notification = ""; // Add initialization for the $notification variable
    ?>
    <div class="status">
        <?php echo $notification; ?>
    </div>

    <?php include_once('./navbar.php'); ?>

    <div class="container">
        <h2>Registration Form</h2>
        <?php if (isset($notification)) { ?>
            <div class="notification">
                <?php echo $notification; ?>
            </div>
        <?php } ?>
        <form name="registration-form" action="" method="POST">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>

            <label for="passport">Passport:</label>
            <input type="text" id="passport" name="passport">

            <label for="identification">National Citizen Identification:</label>
            <input type="text" id="identification" name="identification">

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button class="btn btn-primary" type="submit" name="submit">Register</button>
        </form>
    </div>

    <?php include_once('./footer.php'); ?>

    <?php
    // echo (isset($_POST['submit']));
    // exit();
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the form data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $passport = $_POST['passport'];
        $identification = $_POST['identification'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $dbpassword = $_POST['password'];

        // Validate and sanitize the form data (you can add more validation if needed)
        $firstName = trim($firstName);
        $lastName = trim($lastName);
        $address = trim($address);
        $city = trim($city);
        $country = trim($country);
        $passport = trim($passport);
        $identification = trim($identification);
        $phone = trim($phone);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $ddbpassword = trim($dbpassword);

        // Hash the password using password_hash()
        $hashedPassword = password_hash($ddbpassword, PASSWORD_DEFAULT);

        // Your database credentials
        $servername = "localhost";
        $username = "root";
        $password = ""; // Change the variable name to avoid conflicts
        $dbname = "shopdb";

        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the SQL query
            $stmt = $pdo->prepare("INSERT INTO tbl_customer (first_name, last_name, address, city, country, passport, national_citizen_id, phone, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $address, $city, $country, $passport, $identification, $phone, $email, $hashedPassword]);

            // // Prepare and execute the SQL query
            // $stmt = $conn->prepare("INSERT INTO tbl_customer (first_name, last_name, address, city, country, passport, identification, phone, email, password) VALUES (:name, :email, :subject, :message)");
            // $stmt->bindParam(':name', $name);
            // $stmt->bindParam(':email', $email);
            // $stmt->bindParam(':subject', $subject);
            // $stmt->bindParam(':message', $message);
            // $stmt->execute();

            // Registration successful
            $notification = "Registration successful.";
            header("Location: login.php");
            exit; // Make sure to include the exit statement after the header redirect
        } catch (PDOException $e) {
            // Registration failed
            $notification = "Registration failed: " . $e->getMessage();
        }
    }
    ?>
</body>

</html>