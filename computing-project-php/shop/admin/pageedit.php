<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/page.php'; ?>
<?php
$page = new page();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = $_POST['page_id'];
    // $categoryName = $_POST['catName'];
    $updatePage = $page->update_page($_POST, $id);
}

if (!isset($_GET['pageId']) || $_GET['pageId'] == null) {
    echo "<script>window.location = 'pagelist.php'</script>";
} else {
    
    $id = $_GET['pageId'];    
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Page</h2>
        <div class="block">
            <?php
            if (isset($updatePage)) {
                echo $updatePage;
            }
            ?>
            <?php
            $getpagebyId = $page->getpagebyId($id);
            if ($getpagebyId) {
                while ($resultpage = $getpagebyId->fetch_assoc()) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $resultpage['page_id'] ?>" name="page_id" />
                                    <input type="text" name="title" value="<?= $resultpage['page_title'] ?>" placeholder="Enter Title Name..." class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea name="content" class="tinymce"><?= $resultpage['page_title'] ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Status</label>
                                </td>
                                <td>
                                    <select id="select" name="status">
                                        <option>Select Type</option>
                                        <?php if ($resultpage['status'] == 0) { ?>
                                            <option value="1">Display</option>
                                            <option selected value="0">Hide</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option selected value="1">Display</option>
                                            <option value="0">Hide</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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