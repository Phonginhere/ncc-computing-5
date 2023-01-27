<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
$cat = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['brandId'];
    $categoryName = $_POST['catName'];
    $updateCategory = $cat->update_category($categoryName, $id);
}
if (!isset($_GET['catId']) || $_GET['catId'] == null) {
     echo "<script>window.location = 'catlist.php'</script>";
} else {
    $id = $_GET['catId'];
    if(isset($_SESSION["success"])){
        echo "<span class='success'>Your brand has been updated successfully</span>";
        unset($_SESSION['success']);
    } 
    if(isset($_SESSION["error"])){
        echo "<span class='error'>Brand must not be empty</span>";
        unset($_SESSION['error']);
    } 
   
    if(isset($_SESSION["dberror"])){
        echo "<span class='error'>Update Brand Failed</span>";
        unset($_SESSION['dberror']);
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category</h2>

        <div class="block copyblock">
            <?php
            $get_cate_name = $cat->getcatbyId($id);
            if ($get_cate_name) {
                while ($result = $get_cate_name->fetch_assoc()) {


            ?>
                    <form action="catedit.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="hidden" value="<?php echo $result['catId'] ?>" name="brandId" />
                                    <input type="text" value="<?php echo $result['catName'] ?>" name="catName" placeholder="Enter Category Name to Edit..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>

            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>