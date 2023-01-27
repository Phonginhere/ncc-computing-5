<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$cg = new configclass();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['configId'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $pinterest = $_POST['pinterest'];
    $email = $_POST['email'];
    $updateConfigSMedia = $cg->update_config_social_media($facebook, $twitter, $pinterest, $email, $id);
}
$getconfigId = $cg->show_config_id();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">      
        <?php
            if (isset($updateConfigSMedia)) {
                echo $updateConfigSMedia;
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
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="hidden" value="<?=$resultConfig['config_id']?>" name="configId"/>
                        <input type="text" value="<?=$resultConfig['social_facebook']?>" name="facebook" placeholder="Facebook Page/User Name.." class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" value="<?=$resultConfig['social_pinterest']?>" name="twitter" placeholder="Twitter Page/User Name.." class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Pinterest</label>
                    </td>
                    <td>
                        <input type="text" value="<?=$resultConfig['social_pinterest']?>" name="pinterest" placeholder="Pinterest Page/User Name.." class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" value="<?=$resultConfig['social_mail']?>" name="email" placeholder="Email.." class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
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