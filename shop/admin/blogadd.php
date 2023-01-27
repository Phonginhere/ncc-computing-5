<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php include '../classes/blog.php';?>
<?php 
	$blog = new blog();
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		$insertBlog = $blog->insert_blog($_POST, $_FILES);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Blog</h2>
        <div class="block">
        <?php
			if (isset($insertBlog)) {
				echo $insertBlog;
			}
			?>               
         <form action="blogadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Title Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category_post">
                            <option>------Select Category------</option>
                            <?php 
                                $post = new post();
                                $catlist = $post->show_category_post();
                                if($catlist){
                                while($result = $catlist->fetch_assoc()){
                            ?>
                            <option value="<?php echo $result['id_cate_post']?>"><?php echo $result['title']?></option>
                            <?php 
                            }
                                 }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="blogDesc" class="tinymce"></textarea>
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="content" class="tinymce"></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Blog Status</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Status</option>
                            <option value="1">Display</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


