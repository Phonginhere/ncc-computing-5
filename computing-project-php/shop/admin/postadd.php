<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/post.php';?>
<?php 
	$cat = new post();
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$catName = $_POST['catName'];
        $catDesc = $_POST['catDesc'];
        $catstatus = $_POST['catstatus'];
		$insertCat = $cat->insert_category_post($catName, $catDesc, $catstatus);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category News</h2>
               
               <div class="block copyblock"> 
               <?php
                    if(isset($insertCat)){
                        echo $insertCat;
                    }
                ?>
                 <form autocomplete="off" action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Enter Category News..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="catDesc" placeholder="Enter Description News..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="catstatus">
                                    <option value="0">Display</option>
                                    <option value="1">Hide</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>