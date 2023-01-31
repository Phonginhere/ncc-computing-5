<?php

use PSpell\Config;

 include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$cg = new configclass();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['configId'];
    $slogan = $_POST['slogan'];
    $title = $_POST['title'];
    $updateConfig = $cg->update_config_title_slogan($slogan, $title, $id);
}
$getconfigId = $cg->show_config_id();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">
        <?php
            if (isset($updateConfig)) {
                echo $updateConfig;
            }
            ?>
        <?php
            $getconfigdata = $cg->getconfigbyId($getconfigId);
            if ($getconfigdata) {
                while ($resultConfig = $getconfigdata->fetch_assoc()) {
            ?>               
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="hidden" value="<?=$resultConfig['config_id']?>" name="configId" />
                        <input type="text" value="<?=$resultConfig['title_website']?>" placeholder="Enter Website Title..."  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?=$resultConfig['slogan_website']?>" placeholder="Enter Website Slogan..." name="slogan" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
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
<?php include 'inc/footer.php';?>