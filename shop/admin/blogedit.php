<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php include '../classes/blog.php'; ?>
<?php
$blog = new blog();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = $_POST['blogId'];
    // $categoryName = $_POST['catName'];
    $updateBlog = $blog->update_blog($_POST, $_FILES, $id);
}

if (!isset($_GET['blogId']) || $_GET['blogId'] == null) {
    echo "<script>window.location = 'bloglist.php'</script>";
} else {
    
    $id = $_GET['blogId'];    
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Blog News</h2>
        <div class="block">
            <?php
            if (isset($updateBlog)) {
                echo $updateBlog;
            }
            ?>
            <?php
            $getblogbyId = $blog->getblogbyId($id);
            if ($getblogbyId) {
                while ($resultBlog = $getblogbyId->fetch_assoc()) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $resultBlog['id'] ?>" name="blogId" />
                                    <input type="text" name="titleName" value="<?= $resultBlog['title'] ?>" placeholder="Enter Title Name..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="category_post">
                                        <option>------Select Category------</option>
                                        <?php
                                        $post = new post();
                                        $postlist = $post->show_category_post();
                                        if ($postlist) {
                                            while ($result = $postlist->fetch_assoc()) {
                                        ?>
                                                <option <?php
                                                        if ($result['id_cate_post'] == $resultBlog['category_post']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result['id_cate_post'] ?>"><?php echo $result['title'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea name="description" class="tinymce"><?= $resultBlog['description'] ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea name="content" class="tinymce"><?= $resultBlog['content'] ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img height="90" src="uploads/<?= $resultBlog['image'] ?>"><br>
                                    <input type="file" name="image" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Status</label>
                                </td>
                                <td>
                                    <select id="select" name="status">
                                        <option>Select Type</option>
                                        <?php if ($resultBlog['status'] == 0) { ?>
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