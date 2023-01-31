<?php
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location: login.php');
}
?>
<?php
// if (!isset($_GET['proId']) || $_GET['proId'] == null) {
// 	echo "<script>window.location = '404.php'</script>";
// } else {

// 	$id = $_GET['proId'];
// 	if (isset($_SESSION["success"])) {
// 		// echo "<span class='success'>Your brand has been updated successfully</span>";
// 		// unset($_SESSION['error']);
// 		// unset($_SESSION['dberror']);
// 	}
// 	if (isset($_SESSION["error"])) {
// 		// echo "<span class='error'>Brand must not be empty</span>";
// 		// unset($_SESSION['success']);
// 		// unset($_SESSION['dberror']);
// 	}

// 	if (isset($_SESSION["dberror"])) {
// 		// echo "<span class='error'>Update Brand Failed</span>";
// 		// unset($_SESSION['success']);
// 		// unset($_SESSION['error']);
// 	}
// }
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
// 	$quantity = $_POST['quantity'];
// 	$AddtoCart = $ct->add_to_cart($quantity, $id);
// }
?>
<style>
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
    }

    .wraper_method {
        text-align: center;
        margin: 0 auto;
        width: 550px;
        border: 1px solid #666;
        padding: 20px;
        background-color: cornsilk;
    }
    .wraper_method a {
    padding: 10px;
    background: red;
    color: white;
}
.wraper_method h3 {
    margin-bottom: 20px;
}
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div class="wraper_method">
                    <h3 class="payment">Choose your method payment</h3>
                    <a href="offlinepayment.php">Offline Payment</a>
                    <a href="onlinepayment.php">Online Payment</a>
                    <a style="background:grey" href="cart.php"> << Previous</a>
                </div>

            </div>


        </div>
    </div>
</div>
<?php
include 'inc/footer.php';

?>