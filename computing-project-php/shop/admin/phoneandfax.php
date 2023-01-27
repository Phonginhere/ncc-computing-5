<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$cg = new configclass();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['configId'];
    $phone = $_POST['phone'];
    $fax = $_POST['fax'];
    $updateConfigPhoneandFax = $cg->update_config_phoneandfax($phone, $fax, $id);
}
$getconfigId = $cg->show_config_id();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Phone/Fax Number</h2>
        <?php
        if (isset($updateConfigPhoneandFax)) {
            echo $updateConfigPhoneandFax;
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
                                    <label>Phone number</label>
                                </td>
                                <td>
                                    <input type="hidden" value="<?= $resultConfig['config_id'] ?>" name="configId" />
                                    <input type="text" value="<?= $resultConfig['phone_num'] ?>" placeholder="Enter Phone Number..." name="phone" class="large" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Fax number</label>
                                </td>
                                <td>
                                    <input type="hidden" value="<?= $resultConfig['config_id'] ?>" name="configId" />
                                    <input type="text" value="<?= $resultConfig['fax_num'] ?>" placeholder="Enter Fax Number..." name="fax" class="large" />
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
<?php include 'inc/footer.php'; ?>