<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$cg = new configclass();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['configId'];
    $copyright = $_POST['copyright'];
    $updateConfigCopyright = $cg->update_config_copyright($copyright, $id);
}
$getconfigId = $cg->show_config_id();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php
            if (isset($updateConfigCopyright)) {
                echo $updateConfigCopyright;
            }
            ?>      
              <?php
            $getconfigdata = $cg->getconfigbyId($getconfigId);
            if ($getconfigdata) {
                while ($resultConfig = $getconfigdata->fetch_assoc()) {
            ?>       
        <div class="block copyblock"> 
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="hidden" value="<?=$resultConfig['config_id']?>" name="configId"/>
                        <input type="text" value="<?=$resultConfig['copyright_text']?>" placeholder="Enter Copyright Text..." name="copyright" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <?php
                }
            }
            ?>
    </div>
</div>
<?php include 'inc/footer.php';?>