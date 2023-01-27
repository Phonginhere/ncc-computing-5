<?php
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php
if (!isset($_GET['page']) || $_GET['page'] == null) {
	echo "<script>window.location = '404.php'</script>";
} else {

	$slug = $_GET['page'];
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$getPageDetails = $pg->page_slug_display($slug);
			if ($getPageDetails) {
				while ($resultDetails = $getPageDetails->fetch_assoc()) {
                    // if()
			?>
					<div class="cont-desc span_1_of_2">
						<div class="desc span_3_of_2">
							<h2><?= $resultDetails['page_title'] ?> </h2>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?= $resultDetails['page_content'] ?>.</p>
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
</div>
<?php
include 'inc/footer.php';

?>