<body>
<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $dbpassword = ""; // Replace with your own password
    $dbname = "shopdb";

    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare("SELECT * FROM tbl_customer WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists
    if ($user) {
        // Check if the password is correct
        if (password_verify($password, $user['password'])) {
            // Successful login
            // Store user information in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            // Redirect to the home page or any other desired page
            $redirectURL = "index.php?user_id=" . urlencode($_SESSION['user_id']) . "&user_email=" . urlencode($_SESSION['user_email']);
            header("Location: $redirectURL");
            exit();
        } else {
            // Invalid password
            $message = "Invalid password";
            // Increment login attempts by one
            if (isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts']++;
            } else {
                $_SESSION['login_attempts'] = 1;
            }
        }
    } else {
        // Invalid username
        $message = "Invalid username";
        // Increment login attempts by one
        if (isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts']++;
        } else {
            $_SESSION['login_attempts'] = 1;
        }
    }

    // Check if the user has exceeded the login attempts
    if (isset($_SESSION['login_attempts'])) {
        if ($_SESSION['login_attempts'] >= 3) {
            // Lock the login for 10 minutes
            $_SESSION['login_locked'] = true;
            $_SESSION['login_locked_until'] = time() + (10 * 60); // 10 minutes from now
        }
    }

    // Check if the login is locked
    if (isset($_SESSION['login_locked']) && $_SESSION['login_locked']) {
        // Check if the lock time has expired
        if (time() < $_SESSION['login_locked_until']) {
            $message = "Login is locked. Please try again later.";
        } else {
            // Reset login attempts and unlock the login
            $_SESSION['login_attempts'] = 0;
            $_SESSION['login_locked'] = false;
            $message = "Login is unlocked now.";
        }
    }

    // Display the notification message
    $script = "showNotification('$message');";
}
?>
    <?php include_once('./navbar.php'); ?>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="./img/icon_outdoor_camping.jpg" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">We are The Outdoor Camping Team</h4>
                                    </div>

                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4">
                                            <label for="username">Email:</label>
                                            <input type="text" id="username" name="email" required>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label for="password">Password:</label>
                                            <input type="password" id="password" name="password" required>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <div class="form-group">
                                                <button type="submit">Login</button>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <button type="button" onclick="location.href = './register.php';" id="myButton" class="btn btn-outline-danger">Create new</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="bg-primary col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <div id="notification" class="small mb-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include_once('./footer.php');
    ?>

</body>
<script>
    function showNotification(message) {
        var notification = document.getElementById('notification');
        notification.textContent = message;
        // Your additional notification styling and logic here
    }

    <?php echo $script; ?>
</script>