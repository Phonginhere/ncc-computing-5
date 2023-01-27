<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/product.php'; ?>
<?php
$cg = new configclass();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['configId'];
    $updateConfigImage = $cg->update_config_image($_FILES, $id);
}
$getconfigId = $cg->show_config_id();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Images</h2>
        <div class="block">
        <?php
            if (isset($updateConfigImage)) {
                echo $updateConfigImage;
            }
            ?>      
              <?php
            $getconfigdata = $cg->getconfigbyId($getconfigId);
            if ($getconfigdata) {
                while ($resultConfig = $getconfigdata->fetch_assoc()) {
            ?>       
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Main image</label>
                        </td>
                        <td>
                            <input type="hidden" value="<?=$resultConfig['config_id']?>" name="configId"/>
                            <img height="90" src="uploads/<?= $resultConfig['image_main_web'] ?>"><br>
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Save" />
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