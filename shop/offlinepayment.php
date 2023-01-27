<?php
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    // echo "<script>window.location = '404.php'</script>";
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delCart = $ct->del_all_data_cart();
    header('Location: success.php');
} 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $AddtoCart = $ct->add_to_cart($quantity, $id);
}
?>
<style>
    .box_left {
        width: 50%;
        float: left;
        border: 1px solid #666;
        padding: 4px;
    }

    .box_right {
        width: 47%;
        float: right;
        border: 1px solid #666;
        padding: 4px;
    }
    /* input[type="submit"]  */
    a.a_order{
    background: red;
    padding: 7px 20px;
    border: none;
    font-size: 21px;
    color: white;
    cursor: pointer;
}
</style>
<form action="" method="post">
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Offline Payment</h3>
            </div>
            <div class="clear"></div>
            <div class="box_left">
                <div class="cartpage">
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
                            <th width="5%">ID</th>
                            <th width="30%">Product Name</th>
                            <th width="15%">Price</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Total Price</th>
                        </tr>
                        <?php
                        $get_product_cart = $ct->get_product_cart();
                        if ($get_product_cart) {
                            $subTotal = 0;
                            $qty = 0;
                            $i = 0;
                            while ($result = $get_product_cart->fetch_assoc()) {
                                $i++;

                        ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $result['productName'] ?></td>
                                    <td>$. <?= $result['price'] ?></td>
                                    <td>
                                    <?= $result['quantity'] ?>
                                    </td>
                                    <td>$. <?php $total = $result['price'] * $result['quantity'];
                                            echo $fm->format_currency($total) ;
                                            ?>
                                    </td>
                                </tr>
                        <?php
                                $subTotal += $total;
                                $qty += $result['quantity'];
                            }
                        }
                        ?>
                    </table>
                    <?php
                    $check_cart = $ct->check_cart();
                    if ($check_cart) {
                    ?>
                        <table style="float:right;text-align:left;margin: 5px" width="50%">
                            <tr>
                                <th>Sub Total : </th>
                                <td>$. <?= $fm->format_currency($subTotal);
                                        Session::set('sum', $subTotal);
                                        Session::set('qty', $qty); ?></td>
                            </tr>
                            <tr>
                                <th>VAT : </th>
                                <td>10% ($. <?php $vat = $subTotal * 0.1; echo $fm->format_currency($vat)?>)</td>
                            </tr>
                            <tr>
                                <th>Grand Total :</th>
                                <td>$. <?php $vat = $subTotal * 0.1;
                                    $gTotal = $subTotal + $vat;
                                    echo $fm->format_currency($gTotal); ?> </td>
                            </tr>
                            <tr>
                                <th>Total Quantity :</th>
                                <td><?php echo $qty; ?> items</td>
                            </tr>
                        </table>
                    <?php
                    } else {
                        echo "Your cart is empty. You need to add items";
                    }
                    ?>
                </div>
            </div>
            <div class="box_right">
            <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if ($get_customers) {
                    while ($result = $get_customers->fetch_assoc()) {

                ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?=$result['name']?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?=$result['city']?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?=$result['phone']?></td>
                        </tr>
                        <!-- <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><?=$result['country']?></td>
                        </tr> -->
                        <tr>
                            <td>Zip-code</td>
                            <td>:</td>
                            <td><?=$result['zipcode']?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?=$result['email']?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?=$result['address']?></td>
                        </tr>
                        <tr>
                           <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
            </div>
            
        </div>
        
    </div>
     <center><a href="?orderid=order" class="a_order">Order Now</a></center><br>           
            </form>
</div>
<?php
include 'inc/footer.php';

?>