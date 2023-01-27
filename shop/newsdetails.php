<?php
include 'inc/header.php';

?>
<?php
if (!isset($_GET['blognewsId']) || $_GET['blognewsId'] == null) {
	echo "<script>window.location = 'index.php'</script>";
} else {
	$id = $_GET['blognewsId'];
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$getnewsDetails = $blog->show_cate_blog_related($id);
			if ($getnewsDetails) {
				while ($resultDetailsNews = $getnewsDetails->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?= $resultDetailsNews['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?= $resultDetailsNews['title'] ?> </h2>
							<div class="category_name">
								<p>Category: <span><?= $resultDetailsNews['tcp_title'] ?></span></p>
							</div>
						</div>
						<div class="product-desc">
							<h2>Description</h2>
							<p><?= $resultDetailsNews['description'] ?>.</p>
						</div>
						<div class="product-desc">
							<h2>Content</h2>
							<p><?= $resultDetailsNews['content'] ?>.</p>
						</div>

					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>News CATEGORIES</h2>
				<ul>
					<?php
					$getall_CategoryPost = $post->show_category_post();
					if ($getall_CategoryPost) {
						while ($result_allcate_post = $getall_CategoryPost->fetch_assoc()) {
					?>
							<li><a href="news.php?blogId=<?= $result_allcate_post['id_cate_post'] ?>">
							<?= $result_allcate_post['title'] ?></a></li>
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