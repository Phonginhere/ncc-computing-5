<?php
include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == true){
        // header('Location: order.php');
		$script = "<script>
		window.location = 'order.php';</script>";
		echo $script;
    }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$insertCustomers = $cs->insert_customer($_POST);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
	$loginCustomers = $cs->login_customer($_POST);
}
?>
<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<?php
			if (isset($loginCustomers)) {
				echo $loginCustomers;
			}
			?>
			<form action="" method="post">
				<input type="text" name="email" class="field" placeholder="Enter email......">
				<input type="password" name="password" class="field" placeholder="Enter password......">

				<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
				<div class="buttons">
					<div><input type="submit" name="login" class="grey" value="Sign in"></div>
				</div>
			</form>
		</div>
		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if (isset($insertCustomers)) {
				echo $insertCustomers;
			}
			?>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Enter name...." required>
								</div>

								<div>
									<input type="text" name="city" placeholder="Enter city...." required>
								</div>

								<div>
									<input type="text" name="zipcode" placeholder="Enter Zip-code...." required>
								</div>
								<div>
									<input type="text" name="email" placeholder="Enter e-mail...." required>
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Enter Address...." required>
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="AF">Afghanistan</option>


									</select>
								</div>

								<div>
									<input type="text" name="phone" placeholder="Enter phone number...." required>
								</div>

								<div>
									<input type="text" name="password" placeholder="Enter password...." required>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" class="grey" value="Create Account"></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php';

?>