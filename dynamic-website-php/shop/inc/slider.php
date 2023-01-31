<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLatestDell = $product->getLatestDell();
			if ($getLatestDell) {
				while ($resultDell = $getLatestDell->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?= $resultDell['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Dell</h2>
							<p><?= $resultDell['productName'] ?></p>
							<div class="button"><span><a href="details.php?proId=<?= $resultDell['productId']?>">Details</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLatestApple = $product->getLatestApple();
			if ($getLatestApple) {
				while ($resultApple = $getLatestApple->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"><img src="admin/uploads/<?= $resultApple['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Apple</h2>
							<p><?= $resultApple['productName'] ?></p>
							<div class="button"><span><a href="details.php?proId=<?= $resultApple['productId']?>">Details</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="section group">
			<div class="listview_1_of_2 images_1_of_2">
				<?php
				$getLatestMadebyBoo = $product->getLatestMadebyBoo();
				if ($getLatestMadebyBoo) {
					while ($resultmadebyBoo = $getLatestMadebyBoo->fetch_assoc()) {
				?>
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img src="admin/uploads/<?= $resultmadebyBoo['image'] ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Made By Boo</h2>
							<p><?= $resultmadebyBoo['productName'] ?></p>
							<div class="button"><span><a href="details.php?proId=<?= $resultmadebyBoo['productId']?>">Details</a></span></div>
						</div>
			</div>
	<?php
					}
				}
	?>
	<div class="listview_1_of_2 images_1_of_2">
		<?php
		$getLatestSamsung = $product->getLatestSamsung();
		if ($getLatestSamsung) {
			while ($resultSamsung = $getLatestSamsung->fetch_assoc()) {
		?>
				<div class="listimg listimg_2_of_1">
					<a href="details.php"><img src="admin/uploads/<?= $resultSamsung['image'] ?>" alt="" /></a>
				</div>
				<div class="text list_2_of_1">
					<h2>Samsung</h2>
					<p><?= $resultSamsung['productName'] ?></p>
					<div class="button"><span><a href="details.php?proId=<?= $resultSamsung['productId']?>">Details</a></span></div>
				</div>
	</div>
<?php
			}
		}
?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<?php 
						$get_slider = $product->show_slider();
						if($get_slider){
							while($result = $get_slider->fetch_assoc()){
					?>
					<li><img height="120px" width="500px" src="admin/uploads/<?=$result['slider_image']?>" alt="<?=$result['slider_name']?>" /></li>
					<?php 
							}
						}
					?>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>