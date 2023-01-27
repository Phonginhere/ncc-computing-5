<?php
include './lib/session.php';
Session::init();
?>
<?php
include_once './lib/database.php';
include_once './helpers/format.php';
include_once './classes/config.php';

spl_autoload_register(function ($className) {
	include_once 'classes/' . $className . ".php";
});

$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cat = new category();
$cs = new customer();
$product = new product();
$brand = new brand();
$blog = new blog();
$post = new post();
$cg = new configclass();
$pg = new page();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>

<head>
	<?php
	$cglist = $cg->show_config();
	if ($cglist) {
		$i = 0;
		while ($result = $cglist->fetch_assoc()) {
	?>
			<title>Index page / <?= $result['title_website'] ?></title>
			<link rel="icon" type="image/x-icon" href="admin/uploads/<?= $result['image_main_web'] ?>">
	<?php
		}
	}
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
	<style>
		.success {
			color: green;
			font-size: 18px;
		}

		.error {
			color: red;
			font-size: 18px;
		}

		input.grey {
			background: #fff;
			font-size: 20px;
		}

		.cartpage h2 {
			width: 500px;
		}

		/* .button_details form{
			float: left;
			margin: 0px 5px;
		} */
		.button_details input[type=submit] {
			float: left;
			margin: 5px;
		}

		/* ul.dc_mm-orange li .sub-container.non-mega .sub {
			margin-left: -425px;
			margin-top: -10px;
		} */
		ul .dropdown-menu {
			margin-left: -425px;
			margin-top: -10px;
		}

		.imgclick {
			float: left;
			width: 110px;
			height: 110px;
			background: #000
		}

		.titleaslogan {
			margin-top: 25px;
			margin-left: 10px;
			float: left;
			/* without float here, if "Line 1" and "Line 2" is long -> 
			text will display both at right and bottom the image */
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<?php
			$cglist = $cg->show_config();
			if ($cglist) {
				$i = 0;
				while ($result = $cglist->fetch_assoc()) {
			?>
					<div class="logo">
						<a class="imgclick" href="index.php"><img src="admin/uploads/<?= $result['image_main_web'] ?>" alt="" /></a>

						<div class="titleaslogan">
							<h3><?= $result['title_website'] ?></h3>
							<div style="font-style: italic;">"<?= $result['slogan_website'] ?>"</div>
						</div>

					</div>
			<?php
				}
			}
			?>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="post">
						<input type="text" placeholder="Search products" name="tagProduct" required>
						<input type="submit" name="search_product" value="SEARCH">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product">
								<?php
								$check_cart = $ct->check_cart();
								if ($check_cart) {
									$sum = Session::get("sum");
									$qty = Session::get('qty');
									echo "$. " . $fm->format_currency($sum) . "($qty)";
								} else {
									echo "Empty";
								}
								?>
							</span>
						</a>
					</div>
				</div>
				<?php
				if (isset($_GET['customerid'])) {
					$customer_id = $_GET['customerid'];
					$delCart = $ct->del_all_data_cart();
					$delCompare = $ct->del_compare($customer_id);
					Session::destroy();
				}
				?>
				<div class="login">
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
					?>
						<a href="login.php">Login</a>
				</div> <?php
					} else {
						$check_id = Session::get('customer_id');
						?>
				<a href="?customerid=<?= $check_id ?>">Logout</a>
			</div>
		<?php
					}
		?>

		<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="menu">
		<ul id="dc_mega-menu-orange" class="dc_mm-orange">
			<li><a href="index.php">Home</a></li>
			<li><a href="products.php">Products</a> </li>
			<!-- <li><a href="topbrands.php">Top Brands</a></li> -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					News
					<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<?php
					$pst = $post->show_category_post();
					if ($pst) {
						while ($result_post = $pst->fetch_assoc()) {

					?>
							<li>
								<a href="news.php?blogId=<?= $result_post['id_cate_post'] ?>"><?= $result_post['title'] ?></a>
							</li>
					<?php
						}
					}
					?>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Brand
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<?php
					$brd = $brand->show_brand();
					if ($brd) {
						while ($result_brand = $brd->fetch_assoc()) {

					?>
							<li>
								<a href="topbrands.php?brandId=<?= $result_brand['brandId'] ?>"><?= $result_brand['brandName'] ?></a>
							</li>
					<?php
						}
					}
					?>
				</ul>
			</li>
			<?php
			$check_cart = $ct->check_cart();
			if ($check_cart == true) {
			?>
				<li><a href="cart.php">Cart</a></li>
			<?php
			}
			?>

			<?php
			$customer_id = Session::get('customer_id');
			$check_order = $ct->check_order($customer_id);
			if ($check_order == true) {
			?>
				<li><a href="orderdetails.php">Ordered</a></li>
			<?php
			}
			?>

			<?php
			$login_check = Session::get('customer_login');
			if ($login_check == true) {
			?>
				<li><a href="profile.php">Profile</a> </li>
			<?php
			}
			?>
			<?php
			$login_check = Session::get('customer_login');
			if ($login_check) {
				echo '<li><a href="compare.php">Compare</a> </li>';
			}
			?>
			<?php
			$login_check = Session::get('customer_login');
			if ($login_check) {
				echo '<li><a href="wishlist.php">Wishlist</a> </li>';
			}
			?>
			<li><a href="contact.php">Contact</a> </li>
			<div class="clear"></div>
		</ul>
	</div>