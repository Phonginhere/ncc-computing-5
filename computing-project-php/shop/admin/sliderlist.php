<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/product.php'; ?>
<?php
$product = new product();
if (isset($_GET['type_slider']) && isset($_GET['type'])) {
	$id = $_GET['type_slider'];
	$type = $_GET['type'];
	$update_type_slider = $product->update_typeslider($id, $type);
}
if (isset($_GET['slider_del'])) {
	$id = $_GET['slider_del'];
	$slider_del = $product->del_slider($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">
			<?php 
				if(isset($slider_del)){
					echo $slider_del;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Slider Title</th>
						<th>Slider Image</th>
						<th>Option</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$product = new product();
					$get_slider = $product->show_slider_list();
					if ($get_slider) {
						$i = 0;
						while ($result = $get_slider->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?= $i ?></td>
								<td><?= $result['slider_name'] ?></td>
								<td><img src="uploads/<?= $result['slider_image'] ?>" height="120px" width="500px" /></td>
								<td><?php
									if ($result['type'] == 1) {
									?>
										<a href="?type_slider=<?= $result['id'] ?>&type=<?=0?>">On</a>
									<?php
									} else {
									?>
										<a href="?type_slider=<?= $result['id'] ?>&type=<?=1?>">Off</a>
									<?php
									}
									?>
								</td>
								<td>
									<a href="?slider_del=<?= $result['id'] ?>" onclick="return confirm('Are you sure to Delete!');">Delete</a>
								</td>
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