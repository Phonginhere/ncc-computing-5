<?php include('app_logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="./css/forgetpass.css">
</head>
<body>

	<form class="login-form" action="enter_email.php" method="get" style="text-align: center;">
		<p>
			We sent an email to  <b><?php if (empty($_GET)) {header("location: index.php");}else{echo $_GET['email'];}   ?></b> to help you recover your account. 
		</p>
	    <p>Please login into your email account and click on the link we sent to reset your password</p>
        <p>Back to login page <a href="login.php">here</a>.</p>
	</form>
		
</body>
</html>