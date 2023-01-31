<?php
include 'inc/header.php';

?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tagProduct = $_POST['tagProduct'];
                $search_product = $product->search_product($tagProduct);
            }
            ?>
            <div class="heading">
                <h3>Search product: <?= $tagProduct?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            if ($search_product) {
                while ($result = $search_product->fetch_assoc()) {
            ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="preview-3.php"><img src="admin/uploads/<?= $result['image'] ?>" width="200px" alt="" /></a>
                        <h2><?= $result['productName'] ?> </h2>
                        <p><?= $fm->textShorten($result['productDesc'], 50) ?></p>
                        <p><span class="price">$. <?= $fm->format_currency($result['price']) ?></span></p>
                        <div class="button"><span><a href="details.php?proId=<?= $result['productId'] ?>" class="details">Details</a></span></div>
                    </div>

        </div>
<?php
                }
            } else {
                echo 'Items not available';
            }
?>


    </div>
</div>
<?php
include 'inc/footer.php';

?>