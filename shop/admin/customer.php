<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; 
include_once('../classes/customer.php');
include_once('../helpers/format.php');
?>
<?php
$cs = new customer();
if (!isset($_GET['customerid']) || $_GET['customerid'] == null) {
     echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = $_GET['customerid'];
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
            $get_customer = $cs->show_customers($id);
            if ($get_customer) {
                while ($result = $get_customer->fetch_assoc()) {
            ?>
                    <form action="catedit.php" method="post">
                        <table class="form">
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['name'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['phone'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['city'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['address'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['country'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Zip-code</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['zipcode'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['email'] ?>" name="catName" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['phone'] ?>" name="catName" class="medium" />
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