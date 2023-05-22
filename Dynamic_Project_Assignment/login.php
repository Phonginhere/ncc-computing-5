<body>
<?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = ""; // Replace with your own password
        $dbname = "shopdb";

        // Get the form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            echo "<p>Login successful!</p>";
            // Redirect to the home page or any other desired page
            header("Location: home.php");
            exit();
        } else {
            // Invalid login credentials
            $error = "Invalid username or password";
        }
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

                                    <form>
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
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                        do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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