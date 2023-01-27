 <?php
	include 'inc/header.php';
	include 'inc/slider.php';

	?>

 <div class="main">

 	<div class="content">
 		<div class="content_top">
 			<div class="heading">
 				<h3>Feature Products</h3>
 			</div>
 			<div class="clear"></div>
 		</div>
 		<div class="section group">
 			<?php
				$getproductFeathered = $product->getProduct_feathered();
				if ($getproductFeathered) {
					while ($result = $getproductFeathered->fetch_assoc()) {
				?>
 					<div class="grid_1_of_4 images_1_of_4">
 						<a href="details.php"><img width="550px" height="200px" src="admin/uploads/<?= $result['image'] ?>" alt="" /></a>
 						<h2><?= $result['productName'] ?></h2>
 						<p><?= $fm->textShorten($result['productDesc'], 40) ?> </p>
 						<p><span class="price">$. <?= $fm->format_currency($result['price']) ?></span></p>
 						<div class="button"><span><a href="details.php?proId=<?= $result['productId'] ?>" class="details">Details</a></span></div>
 					</div>
 			<?php
					}
				}
				?>
 		</div>
 		<div class="content_bottom">
 			<div class="heading">
 				<h3>New Products</h3>
 			</div>
 			<div class="clear"></div>
 		</div>
 		<div class="section group">
 			<?php
				$getproductNew = $product->getProduct_new();
				if ($getproductNew) {
					while ($resultNew = $getproductNew->fetch_assoc()) {
				?>
 					<div class="grid_1_of_4 images_1_of_4">
 						<a href="details.php"><img width="550px" height="200px" src="admin/uploads/<?= $resultNew['image'] ?>" alt="" /></a>
 						<h2><?= $resultNew['productName'] ?></h2>
 						<p><?= $fm->textShorten($resultNew['productDesc'], 40) ?> </p>
 						<p><span class="price">$. <?= $fm->format_currency($resultNew['price']) ?></span></p>
 						<div class="button"><span><a href="details.php?proId=<?= $resultNew['productId'] ?>" class="details">Details</a></span></div>
 					</div>

 			<?php
					}
				}
				?>
 		</div>
 		<div class="">
 			<nav aria-label="Page navigation example">
 				<ul class="pagination">
				 <?php
				$product_all = $product->get_all_product();
				$product_count = mysqli_num_rows($product_all);
				$product_button = ceil($product_count / 4);
				$i = 1;
				for ($i = 1; $i <= $product_button; $i++) {
					echo '<li  class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
				}
				?>
 				</ul>
 			</nav>
 			

 		</div>
 	</div>
 </div>
 <?php
	include 'inc/footer.php';

	?>