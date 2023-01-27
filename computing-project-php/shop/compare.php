<?php
include 'inc/header.php';

?>
<?php
// if (isset($_GET['cartId'])) {
// 	$cartId = $_GET['cartId'];
// 	$delCart = $ct->del_product_cart($cartId);
// }
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
// 	$cartId = $_POST['cartId'];
// 	$quantity = $_POST['quantity'];
// 	$updateQuatityCart = $ct->update_quantity_cart($quantity, $cartId);
// 	if ($quantity <= 0) {
// 		$delCart = $ct->del_product_cart($cartId);
// 	}
// }
?>
<!-- <?php
        if (!isset($_GET['id'])) {
            echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
        }
        ?> -->
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Compare Products</h2>
                <?php
                if (isset($updateQuatityCart)) {
                    echo $updateQuatityCart;
                }
                ?>
                <?php
                if (isset($delCart)) {
                    echo $delCart;
                }
                ?>
                <table class="tblone">
                    <tr>
                        <th width="10%">Id Compare</th>
                        <th width="20%">Product Name</th>
                        <th width="20%">Image</th>
                        <th width="15%">Price</th>
                        <th width="15%">Action</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_compare = $product->get_compare($customer_id);
                    if ($get_compare) {
                        $i = 0;
                        while ($result = $get_compare->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?= $result['image'] ?>" alt="" /></td>
                                <td>$. <?= $fm->format_currency($result['price']) ?></td>
                                <td><a href="details.php?proId=<?= $result['product_id'] ?>">View</a></td>
                            </tr>
                    <?php

                        }
                    }
                    ?>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                   <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include 'inc/footer.php';

?>