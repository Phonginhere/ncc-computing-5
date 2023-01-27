<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class blog
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_blog($data, $files)
    {

        // mysqli needs 2 varibles
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $category_post = mysqli_real_escape_string($this->db->link, $data['category_post']);
        $blogDesc = mysqli_real_escape_string($this->db->link, $data['blogDesc']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //check validation image and put image data into folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        // $duplicate = mysqli_query($this->db->link, "select * from tbl_product where catName ='$catName'");
        // echo $type;
        // exit();
        if (
            empty($title) || empty($category_post) || empty($content) || empty($blogDesc) || empty($type)
        ) {
            $alert = "<span class='error'>Feilds must be not empty</span>";
            return $alert;
            // } 
            // elseif (mysqli_num_rows($duplicate) > 0) {
            //     $alert = "<span class='error'>Product already exists</span>";
            //     return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_blog(title, description, content, category_post, image, status) 
            VALUES ('$title', '$blogDesc', '$content', '$category_post', '$unique_image', '$type')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span class='success'>Insert Blog Post Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Blog Post Failed</span>";
                return $alert;
            }
        }
    }

  

    public function show_blog()
    {
        $query = "SELECT tb.*, tcp.title
         FROM tbl_blog as tb 
         INNER JOIN tbl_category_post as tcp
         on tb.category_post = tcp.id_cate_post 
         order by id desc";

        $result = $this->db->select($query);
        return $result;
    }
    public function getblogbyId($id)
    {
        $query = "SELECT * FROM tbl_blog WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_blog($data, $files, $id)
    {

        // mysqli needs 2 varibles
        $titleName = mysqli_real_escape_string($this->db->link, $data['titleName']);
        $category_post = mysqli_real_escape_string($this->db->link, $data['category_post']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);

        //check validation image and put image data into folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div)); //take last character ex: jpg/png format, current: take the name image file
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (
            empty($titleName) || empty($category_post) || empty($description) || empty($content)
        ) {
            session_start();
            // $_SESSION["error"] = "Blog news post must not be empty";
            // echo "<script>window.location = 'blogedit.php?blogId=$id'</script>";
            $alert = "<span class='error'>Blog news must not be empty</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                //if user chooses image
                if ($file_size > 2000000) {
                    // $_SESSION["error"] = "<span class='error'>Image size should be less than 20MB!</span>";
                    $alert = "<span class='error'>Image size should be less than 20MB!</span>";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {
                    // $_SESSION["error"] = "<span class='error'>You can upload only: " . implode(', ', $permited) . "!</span>";
                    $alert = "<span class='error'>You can upload only: " . implode(', ', $permited) . "!</span>";
                    return $alert;
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_blog
                    SET title  = '$titleName', 
                    description  = '$description',
                    content  = '$content', 
                    category_post  = '$category_post', 
                    status  = '$status', 
                    image  = '$unique_image' 
                    WHERE id = '$id'";
                }
            } else {
                //if user doesn't choose image
                $query = "UPDATE tbl_blog SET title  = '$titleName', description  = '$description', 
                content  = '$content', category_post  = '$category_post', status  = '$status' WHERE id = '$id'";
            }
            $result = $this->db->update($query);
            if ($result == true) {
                // $_SESSION["success"] = "Update Blog Post Successfully";
                // echo "<script>window.location = 'blogedit.php?blogId=$id'</script>";
                $alert = "<span class='success'>Update Blog Post Successfully</span>";
                return $alert;
            } else {
                // $_SESSION["dberror"] = "Update Blog Post Failed";
                // echo "<script>window.location = 'blogedit.php?blogId=$id'</script>";
                $alert = "<span class='error'>Update Blog Post Failed</span>";
                return $alert;
            }
        }
    }

    public function del_blog($id)
    {
        $query = "DELETE FROM tbl_blog WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span class='success'>Blog Delete Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Blog Failed</span>";
            return $alert;
        }
        return $result;
    }

    //End back-end
    public function show_cate_blog_related($id)
    {
        $query = "SELECT tb.*, tcp.title as tcp_title
         FROM tbl_blog as tb 
         INNER JOIN tbl_category_post as tcp
         on tb.category_post = tcp.id_cate_post 
         where id_cate_post = '$id' LIMIT 1";

        $result = $this->db->select($query);
        return $result;
    }
}

?>