<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php
$brand = new brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['brandId'];
    $brandName = $_POST['brandName'];
    $updateBrand = $brand->update_brand($brandName, $id);
}
if (!isset($_GET['brandId']) || $_GET['brandId'] == null) {
    echo "<script>window.location = 'brandlist.php'</script>";
} else {
    $id = $_GET['brandId'];
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
        <h2>Edit brand</h2>

        <div class="block copyblock">
            <?php
            $get_brand_name = $brand->getbrandbyId($id);
            if ($get_brand_name) {
                while ($result = $get_brand_name->fetch_assoc()) {


            ?>
                    <form action="brandedit.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="hidden" value="<?php echo $result['brandId'] ?>" name="brandId" />
                                    <input type="text" value="<?php echo $result['brandName'] ?>" name="brandName" placeholder="Enter brand Name to Edit..." class="medium" />
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