<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/page.php';?>

<?php 
	$page = new page();
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
		$insertPage = $page->insert_page($_POST);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Page</h2>
        <div class="block">
        <?php
			if (isset($insertPage)) {
				echo $insertPage;
			}
			?>               
         <form action="pageadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Title Name..." class="medium" />
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
                        <label>Page Status</label>
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


