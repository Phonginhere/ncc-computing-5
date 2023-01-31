<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php 
	$fm = new Format();
	$pd = new product();
	if (isset($_GET['productId'])) {
		$id = $_GET['productId'];
		$delPro = $pd->del_product($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Product List</h2>
		<div class="block">
			<?php 
				if(isset($delPro)){
					echo $delPro;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Image</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pdlist = $pd->show_product();
					if ($pdlist) {
						$i = 0; 
						while ($result = $pdlist->fetch_assoc()) {
							$i++; 
					?>
							<tr class="odd gradeX">
								<td><?=$i?></td>
								<td><?=$result['productName']?></td>
								<td><?=$result['price']?></td>
								<td><img height="90" src="uploads/<?=$result['image']?>"></td>
								<td><?=$result['catName']?></td>
								<td><?=$result['brandName']?></td>
								<td><?php echo $fm->textShorten($result['productDesc'], 50); ?></td>
								<td class="center"> <?php if($result['type'] == 0){echo 'Non-Featured';}else{echo 'Featured';}?></td>
								<td><a href="productedit.php?productId=<?php echo $result['productId']?>">Edit</a> 
								|| <a href="?productId=<?php echo $result['productId']?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>