<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php
$post = new post();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_cate_post'];
    $catName = $_POST['catName'];
    $catDesc = $_POST['catDesc'];
    $catstatus = $_POST['catstatus'];
    $updateCategory = $post->update_category_post($catName, $catDesc, $catstatus, $id);
}
if (!isset($_GET['catId']) || $_GET['catId'] == null) {
    echo "<script>window.location = 'postlist.php'</script>";
} else {
    $id = $_GET['catId'];
    if (isset($_SESSION["success"])) {
        echo "<span class='success'>Your Category Post has been updated successfully</span>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION["error"])) {
        echo "<span class='error'>Category Post must not be empty</span>";
        unset($_SESSION['error']);
    }

    if (isset($_SESSION["dberror"])) {
        echo "<span class='error'>Update Category Post Failed</span>";
        unset($_SESSION['dberror']);
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Category Post News</h2>

        <div class="block copyblock">
            <?php
            $get_cate_name = $post->getcatbyId($id);
            if ($get_cate_name) {
                while ($result = $get_cate_name->fetch_assoc()) {


            ?>
                    <form action="postedit.php" method="post">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="hidden" value="<?php echo $result['id_cate_post'] ?>" name="id_cate_post" />
                                    <input type="text" value="<?php echo $result['title'] ?>" name="catName" placeholder="Enter Category Name to Edit..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['description'] ?>" name="catDesc" placeholder="Enter Description News..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="catstatus" >
                                        <?php 
                                            if($result['status'] == 0){
                                                ?> 
                                                <option value="0" selected>Display</option> 
                                                <option value="1">Hide</option> 
                                                <?php
                                            }else{
                                                ?>
                                                <option value="0">Display</option> 
                                                <option value="1" selected>Hide</option> 
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
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
<?php include 'inc/footer.php'; ?>