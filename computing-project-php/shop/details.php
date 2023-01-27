<?php
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php
if (!isset($_GET['proId']) || $_GET['proId'] == null) {
	echo "<script>window.location = '404.php'</script>";
} else {

	$id = $_GET['proId'];
}
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {
	$productId = $_POST['productid'];
	$insertCompare = $product->insertCompare($productId, $customer_id);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist'])) {
	$productId = $_POST['productid'];
	$insertWishlist = $product->insertWishlist($productId, $customer_id);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$insertCart = $ct->add_to_cart($quantity, $id);
}
if (isset($_POST['comment_submit'])) {
	$insert_comment = $cs->insert_comment();
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$getProductDetails = $product->get_details($id);
			if ($getProductDetails) {
				while ($resultDetails = $getProductDetails->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?= $resultDetails['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?= $resultDetails['productName'] ?> </h2>
							<div class="price">
								<p>Price: <span>$. <?= $fm->format_currency($resultDetails['price']) ?></span></p>
								<p>Category: <span><?= $resultDetails['catName'] ?></span></p>
								<p>Brand:<span><?= $resultDetails['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />

								</form>
								<?php
								if (isset($AddtoCart)) {
									echo '<span style="color:red; font-size: 18px;">Product Already Added</span>';
								}
								?>
							</div>
							<div class="add-cart">
								<div class="button_details">
									<form action="" method="post">
										<!-- <a href="?wlist=<?php echo $resultDetails['productId'] ?>" class="buysubmit">Save to WishList</a> -->
										<!-- <a href="?compare=<?php echo $resultDetails['productId'] ?>" class="buysubmit">Compared Products</a> -->
										<input type="hidden" name="productid" value="<?= $resultDetails['productId'] ?>" />


										<?php
										$login_check = Session::get('customer_login');
										if ($login_check) {
											echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product"/>' . ' ';
										} else {
											echo '';
										}
										?>

									</form>


									<form action="" method="post">
										<!-- <a href="?wlist=<?php echo $resultDetails['productId'] ?>" class="buysubmit">Save to WishList</a> -->
										<!-- <a href="?compare=<?php echo $resultDetails['productId'] ?>" class="buysubmit">Compared Products</a> -->
										<input type="hidden" name="productid" value="<?= $resultDetails['productId'] ?>" />


										<?php
										$login_check = Session::get('customer_login');
										if ($login_check) {
											echo '<input type="submit" class="buysubmit" name="wishlist" value="Save to wishlist"/><br>';
										} else {
											echo '';
										}
										?>
									</form>
								</div>
								<div class="clear"></div>
								<p>
									<?php
									if (isset($insertCompare)) {
										echo $insertCompare;
									}
									?>
									<?php
									if (isset($insertWishlist)) {
										echo $insertWishlist;
									}
									?>
								</p>

							</div>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?= $resultDetails['productDesc'] ?>.</p>
						</div>

					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
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
		</div>
	</div>
	<div class="comment">
		<div class="row">
			<div class="col-md-8">
				<h5>Comment: </h5>
				<?php 
					if(isset($insert_comment)){
						echo $insert_comment;
					}
				?>
				<form action="" method="post">
					<p><input type="hidden" value="<?=$id?>" name="product_id_comment"></p>
					<p><input type="text" placeholder="Enter your name" class="form-control" name="namepersonComment"></p>
					<p><textarea row="5" style="resize:none;" class="form-control" name="comment" placeholder="Click here to comment"></textarea></p>
					<p><input type="submit" name="comment_submit" class="btn btn-success" value="Send comment"></p>
				</form>
			</div>
		</div>



	</div>
</div>
<?php
include 'inc/footer.php';

?>