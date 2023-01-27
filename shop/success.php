<?php
include 'inc/header.php';
// include 'inc/slider.php';

?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == null) {
    // echo "<script>window.location = '404.php'</script>";
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delCart = $ct->del_all_data_cart();
    header('Location: success.php');
}
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
//     $quantity = $_POST['quantity'];
//     $AddtoCart = $ct->add_to_cart($quantity, $id);
// }
// ?>
<style>
    h2.success_order{
        text-align: center;
        color: red;
    }
    p.success_note{
        text-align: center;
        padding: 6px;
        font-size: 17px;
    }
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Success Order</h2>
                <?php 
                    $customer_id = Session::get('customer_id');
                    $get_amount = $ct->get_amount_price($customer_id);
                    if($get_amount){
                        $amount = 0;
                        while($result = $get_amount->fetch_assoc()){
                            $price = $result['price'];
                            $amount += $price;
                        }
                    }
                ?>
                <p class="success_note">Total Price You Have Bought From My Website : $. <?php $vat = $amount * 0.1;  $total = $vat + $amount; echo $fm->format_currency($total)?></p>
                <P class="success_note">We will contact as soon as possible. Please see your order details here <a href="orderdetails.php">Click Here!</a></P>
            </div>
        </div>
</form>
</div>
<?php
include 'inc/footer.php';

?>