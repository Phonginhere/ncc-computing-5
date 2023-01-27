<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = $_POST['productId'];
    // $categoryName = $_POST['catName'];
    $updateProduct = $pd->update_product($_POST, $_FILES, $id);
}

if (!isset($_GET['productId']) || $_GET['productId'] == null) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    
    $id = $_GET['productId'];
    if (isset($_SESSION["success"])) {
        echo "<span class='success'>Your brand has been updated successfully</span>";
        unset($_SESSION['error']);
        unset($_SESSION['dberror']);
    }
    if (isset($_SESSION["error"])) {
        echo "<span class='error'>Brand must not be empty</span>";
        unset($_SESSION['success']);
        unset($_SESSION['dberror']);
    }

    if (isset($_SESSION["dberror"])) {
        echo "<span class='error'>Update Brand Failed</span>";
        unset($_SESSION['success']);
        unset($_SESSION['error']);
    }
    
    
    
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">
            <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>
            <?php
            $getproductbyId = $pd->getproductbyId($id);
            if ($getproductbyId) {
                while ($resultProduct = $getproductbyId->fetch_assoc()) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $resultProduct['productId'] ?>" name="productId" />
                                    <input type="text" name="productName" value="<?= $resultProduct['productName'] ?>" placeholder="Enter Product Name..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="category">
                                        <option>------Select Category------</option>
                                        <?php
                                        $cat = new category();
                                        $catlist = $cat->show_category();
                                        if ($catlist) {
                                            while ($result = $catlist->fetch_assoc()) {
                                        ?>
                                                <option <?php
                                                        if ($result['catId'] == $resultProduct['catId']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Brand</label>
                                </td>
                                <td>
                                    <select id="select" name="brand">
                                        <option>------Select Brand------</option>
                                        <?php
                                        $brand = new brand();
                                        $brandlist = $brand->show_brand();
                                        if ($brandlist) {
                                            while ($result = $brandlist->fetch_assoc()) {
                                        ?>
                                                <option <?php
                                                        if ($result['brandId'] == $resultProduct['brandId']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
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
                                    <textarea name="productDesc" class="tinymce"><?= $resultProduct['productDesc'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input type="text" value="<?= $resultProduct['price'] ?>" name="price" placeholder="Enter Price..." class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img height="90" src="uploads/<?= $resultProduct['image'] ?>"><br>
                                    <input type="file" name="image" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="type">
                                        <option>Select Type</option>
                                        <?php if ($resultProduct['type'] == 0) { ?>
                                            <option value="1">Featured</option>
                                            <option selected value="0">Non-Featured</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option selected value="1">Featured</option>
                                            <option value="0">Non-Featured</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>