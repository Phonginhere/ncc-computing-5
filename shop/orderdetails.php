<?php
include 'inc/header.php';

?>
<?php
// if (isset($_GET['cartId'])) {
// 	$cartId = $_GET['cartId'];
	// $delCart = $ct->del_product_cart($cartId);
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
<?php 
	$login_check = Session::get('customer_login');
	if ($login_check == false) {
		header('Location: login.php');
	}
	$ct = new cart();
	if (isset($_GET['confirmid'])) {
		$id = $_GET['confirmid'];
		$price = $_GET['price'];
		$time = $_GET['time'];
		$shifted_confirm = $ct->shifted_confirm($id, $time, $price);
	}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Details Ordered</h2>

				<table class="tblone">
					<tr>
						<th width="10%">ID</th>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="10%">Date</th>
						<th width="10%">Status</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$customerId = Session::get('customer_id');
					$get_cart_ordered = $ct->get_cart_ordered($customerId);
					
					if ($get_cart_ordered) {
						$i = 0;
						while ($result = $get_cart_ordered->fetch_assoc()) {
							$i++;
					?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $result['productName'] ?></td>
								<td><img src="admin/uploads/<?= $result['image'] ?>" alt="" /></td>
								<td>$. <?= $fm->format_currency($result['price']) ?></td>
								<td><?= $result['quantity'] ?></td>
								<td><?= $fm->formatDate($result['date_order']) ?></td>
								<td>
								<?php 
									if($result['status'] == 0){
										echo 'Pending';
									}elseif($result['status'] == 1) {
										?> <span>Shifted</span>
										 
										<?php
									}elseif($result['status'] == 2){
										echo 'Received';
									}
									?>
								</td>
									<?php 
									if($result['status'] == '0'){
										?><td><?php echo 'N/A'?> </td><?php
									}elseif($result['status'] == '1'){
										?> <td> <a href="?confirmid=<?php 
										echo $customerId ?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?>">Confirmed</a> </td>
										<?php
									}else{
										$result = $result['id'];
									?>	<td><?='Received'?></td> <?php
									}
									?>
								
								
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