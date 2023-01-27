<?php
include 'inc/header.php';

?>
<?php
if (isset($_GET['cartId'])) {
	$cartId = $_GET['cartId'];
	$delCart = $ct->del_product_cart($cartId);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$updateQuatityCart = $ct->update_quantity_cart($quantity, $cartId);
	if ($quantity <= 0) {
		$delCart = $ct->del_product_cart($cartId);
	}
}
?>
<?php 
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
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
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$get_product_cart = $ct->get_product_cart();
					if ($get_product_cart) {
						$subTotal = 0;
						$qty = 0;
						while ($result = $get_product_cart->fetch_assoc()) {

					?>
							<tr>
								<td><?= $result['productName'] ?></td>
								<td><img src="admin/uploads/<?= $result['image'] ?>" alt="" /></td>
								<td>$. <?= $fm->format_currency($result['price'])?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?= $result['cartId'] ?>" />
										<input type="number" name="quantity" min="0" value="<?= $result['quantity'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td>$. <?php $total = $result['price'] * $result['quantity'];
										echo $fm->format_currency($total);
										?>
								</td>
								<td><a href="?cartId=<?= $result['cartId'] ?>">Delete</a></td>
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
				<table style="float:right;text-align:left;" width="30%">
					<tr>
						<th>Sub Total : </th>
						<td>$. <?= $fm->format_currency($subTotal);
								Session::set('sum', $subTotal);
								Session::set('qty', $qty); ?></td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>10%</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td><?php $vat = $subTotal * 0.1;
							$gTotal = $subTotal + $vat;
							echo $fm->format_currency($gTotal); ?> </td>
					</tr>
				</table>
				<?php 
					}else{
						echo "Your cart is empty. You need to add items";
					}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include 'inc/footer.php';

?>