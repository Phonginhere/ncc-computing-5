<?php
include 'inc/header.php';

?>
<?php
if (isset($_GET['proId'])) {
        $customer_id = Session::get('customer_id');
    	$proId = $_GET['proId'];
    	$delWishlist = $product->del_wishlist($proId, $customer_id);
    }
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Wishlist </h2>
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
                    $get_wishlist = $product->get_wishlist($customer_id);
                    if ($get_wishlist) {
                        $i = 0;
                        while ($result = $get_wishlist->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?= $result['image'] ?>" alt="" /></td>
                                <td>$. <?= $fm->format_currency($result['price']) ?></td>
                                <td>
                                    <a href="details.php?proId=<?= $result['product_id'] ?>">Buy Now</a> ||
                                    <a href="?proId=<?= $result['product_id'] ?>">Remove</a>
                                </td>
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