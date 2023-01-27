</div>
<div class="footer">
	<div class="wrapper">
		<div class="section group">
			<div class="col_1_of_4 span_1_of_4">
				<h4>Categories</h4>
				<ul>
					<?php
					$getall_Category = $cat->show_category_frontEnd();
					if ($getall_Category) {
						while ($result_allcate = $getall_Category->fetch_assoc()) {
					?>
							<li><a href="productbycat.php?catId=<?= $result_allcate['catId'] ?>"><?= $result_allcate['catName'] ?></a></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Why buy from us</h4>
				<ul>
				<?php
				$pagelist = $pg->show_page();
				if ($pagelist) {
					while ($resultPage = $pagelist->fetch_assoc()) {
						if($resultPage['status'] == 1){
				?>
					<li><a href="detail_page.php?page=<?=$resultPage['slug']?>"><?=$resultPage['page_title']?></a></li>
					<?php
						}
					}
				}
				?>
					<li><a href="contact..php"><span>Site Map</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>My account</h4>
				<ul>
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
					?> <li><a href="login.php">Login/Sign-in</a></li>
					<?php
					} else {
						$check_id = Session::get('customer_id');
					?>
						<li><a href="?customerid=<?= $check_id ?>">Logout</a></li>
					<?php
					}
					?>
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
						<li><a href="orderdetails.php">Track My Order</a></li>
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
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<?php
				$cglist = $cg->show_config();
				if ($cglist) {
					while ($result = $cglist->fetch_assoc()) {
				?>
						<h4>Contact</h4>
						<ul>
							<li><span><?= $result['phone_num'] ?></span></li>
							<li><span><?= $result['fax_num'] ?> (Fax)</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
							<ul style="display: flex; gap: 35px;">
								<a href="https://www.facebook.com/<?= $result['social_facebook'] ?>" target="_blank">
									<div class="facebook button-big">
										<i style="color:aqua" class="fab fa-facebook-f icon" aria-hidden="true"></i>
									</div>
								</a>
								<a href="https://www.twitter.com/<?= $result['social_twitter'] ?>" target="_blank">
									<div class="twitter button-big">
										<i style="color:white" class="fab fa-twitter"></i>
									</div>
								</a>
								<a href="https://www.pinterest.com/<?= $result['social_pinterest'] ?>" target="_blank">
									<div class="pinterest button-big">
										<i style="color:red" class="fab fa-pinterest"></i>
									</div>
								</a>
								<a href="mailto:<?= $result['social_mail'] ?>" target="_blank">
									<div class="google button-big">
										<i style="color:green" class="fab fa-google"></i>
									</div>
								</a>
								<div class="clear"></div>
							</ul>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
		<div class="copy_right">
			<?php
			$cglist = $cg->show_config();
			if ($cglist) {
				$i = 0;
				while ($result = $cglist->fetch_assoc()) {
			?>
					<p><?= $result['copyright_text'] ?> </p>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
	$(function() {
		SyntaxHighlighter.all();
	});
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			start: function(slider) {
				$('body').removeClass('loading');
			}
		});
	});
</script>
</body>
</.php>