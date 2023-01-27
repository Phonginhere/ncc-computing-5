<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/page.php'; ?>
<?php 
	$page = new page();
	if (isset($_GET['pageId'])) {
		$id = $_GET['pageId'];
		$delPage = $page->del_page($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Product List</h2>
		<div class="block">
			<?php 
				if(isset($delPage)){
					echo $delPage;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Status</th>
                        <th>Slug</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pagelist = $page->show_page();
					if ($pagelist) {
						$i = 0; 
						while ($result = $pagelist->fetch_assoc()) {
							$i++; 
					?>
							<tr class="odd gradeX">
								<td><?=$i?></td>
								<td><?=$result['page_title']?></td>
								<td class="center"> <?php if($result['status'] == 1){echo 'Display';}else{echo 'Hide';}?></td>
                                <td><?=$result['slug']?></td>
								<td><a href="pageedit.php?pageId=<?php echo $result['page_id']?>">Edit</a> 
								|| <a href="?pageId=<?php echo $result['page_id']?>">Delete</a></td>
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