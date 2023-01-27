<?php
include 'inc/header.php';

?>
<?php
if (!isset($_GET['brandId']) || $_GET['brandId'] == null) {
	echo "<script>window.location = 'index.php'</script>";
} else {
	$id = $_GET['brandId'];
}
?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<?php
				$getbrandbyId = $brand->getbrandbyId($id);
				if ($getbrandbyId) {
					while ($resultBrand = $getbrandbyId->fetch_assoc()) {
				?>
						<h3><?= $resultBrand['brandName'] ?></h3>
				<?php
					}
				}
				?>
			</div>
			<div class="clear"></div>
		</div>

		<div class="section group">
			<?php
			$getbrandbyId_showProduct = $brand->show_brand_product($id);
			if ($getbrandbyId_showProduct) {
				while ($resultBrandProduct = $getbrandbyId_showProduct->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img width="550px" height="200px" src="admin/uploads/<?= $resultBrandProduct['image'] ?>" alt="" /></a>
						<h2><?=$resultBrandProduct['productName'] ?> </h2>
						<p><?= $fm->textShorten($resultBrandProduct['productDesc'], 40) ?></p>
						<p><span class="price">$. <?= $fm->format_currency($resultBrandProduct['price'])?></span></p>
						<div class="button"><span><a href="details.php?proId=<?= $resultBrandProduct['productId']?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}else{
                echo '<div class="error">There is nothing to display</div>';
            }
			?>
		</div>

		<!-- <//?php
				$getbrandfull = $brand->show_brand_product_all();
				if ($getbrandfull) {
					while ($resultBrandfull = $getbrandfull->fetch_assoc()) {
				?>
		<div class="content_bottom">
			<div class="heading">
				<h3><?=$resultBrandfull['brandName']?></h3>
			</div>
			<div class="clear"></div>
		</div>
		<//?php
				}
			}
			?>
		<div class="section group">
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-3.php"><img src="images/new-pic1.jpg" alt="" /></a>
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$403.66</span></p>

				<div class="button"><span><a href="details.php" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-4.php"><img src="images/new-pic2.jpg" alt="" /></a>
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$621.75</span></p>
				<div class="button"><span><a href="details.php" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-2.php"><img src="images/feature-pic2.jpg" alt="" /></a>
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$428.02</span></p>
				<div class="button"><span><a href="details.php" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<img src="images/new-pic3.jpg" alt="" />
				<h2>Lorem Ipsum is simply </h2>
				<p><span class="price">$457.88</span></p>
				<div class="button"><span><a href="details.php" class="details">Details</a></span></div>
			</div>
		</div> -->
		
	</div>
</div>
<?php
include 'inc/footer.php';

?>