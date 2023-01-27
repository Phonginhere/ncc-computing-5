<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php include '../classes/blog.php'; ?>
<?php 
	$blog = new blog();
	if (isset($_GET['blogId'])) {
		$id = $_GET['blogId'];
		$delBlog = $blog->del_blog($id);
	}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Product List</h2>
		<div class="block">
			<?php 
				if(isset($delBlog)){
					echo $delBlog;
				}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Description</th>
						<th>Image</th>
						<th>Category</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$bloglist = $blog->show_blog();
					if ($bloglist) {
						$i = 0; 
						while ($result = $bloglist->fetch_assoc()) {
							$i++; 
					?>
							<tr class="odd gradeX">
								<td><?=$i?></td>
								<td><?=$result['title']?></td>
								<td><?=$result['description']?></td>
								<td><img height="90" src="uploads/<?=$result['image']?>"></td>
								<td><?=$result['title']?></td>
								<td class="center"> <?php if($result['status'] == 1){echo 'Display';}else{echo 'Hide';}?></td>
								<td><a href="blogedit.php?blogId=<?php echo $result['id']?>">Edit</a> 
								|| <a href="?blogId=<?php echo $result['id']?>">Delete</a></td>
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