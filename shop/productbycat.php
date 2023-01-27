<?php
include 'inc/header.php';

?>
<?php
if (!isset($_GET['catId']) || $_GET['catId'] == null) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['catId'];
}
$cat = new category();
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// 	$id = $_POST['brandId'];
// 	$categoryName = $_POST['catName'];
// 	$updateCategory = $cat->update_category($categoryName, $id);
// }
?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<?php
			$name_cat = $cat->get_name_by_cat($id);
			if ($name_cat) {
				while ($result_name = $name_cat->fetch_assoc()) {
			?>
					<div class="heading">
						<h3>Category: <?= $result_name['catName'] ?></h3>
					</div>
			<?php
				}
			}else{
				?><div class="heading"><h3>Category: Not available</h3></div><?php 
			}
			?>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$productBycat = $cat->get_product_by_cat($id);
			if ($productBycat) {
				while ($result = $productBycat->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php"><img src="admin/uploads/<?= $result['image'] ?>" width="200px" alt="" /></a>
						<h2><?= $result['productName'] ?> </h2>
						<p><?= $fm->textShorten($result['productDesc'], 50) ?></p>
						<p><span class="price">$. <?= $fm->format_currency($result['price']) ?></span></p>
						<div class="button"><span><a href="details.php?proId=<?= $result['productId'] ?>" class="details">Details</a></span></div>
					</div>

		</div>
<?php
				}
			}else{
				echo 'Items not available';
			}
?>


	</div>
</div>
<?php
include 'inc/footer.php';

?>