<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class post
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category_post($catName, $catDesc, $catstatus)
    {
        //check validation of user and pass
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catstatus);

        // mysqli needs 2 varibles
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catDesc = mysqli_real_escape_string($this->db->link, $catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link, $catStatus);

        $duplicate = mysqli_query($this->db->link, "select * from tbl_category_post where title ='$catName'");

        if (empty($catName) || empty($catDesc)) {
            $alert = "<span class='error'>Feilds must not be empty</span>";
            return $alert;
        } elseif (mysqli_num_rows($duplicate) > 0) {
            $alert = "<span class='error'>Category already exists</span>";
            return $alert;
        } else {
            // echo $catstatus;
            // exit();
            $query = "INSERT INTO `tbl_category_post`(`title`, `description`, `status`) 
            VALUES ('$catName','$catDesc','$catStatus')";
            // $query = "INSERT INTO tbl_category_post(title, description, status) VALUES ('$catName', '$catDesc', $catStatus')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span class='success'>Insert Category Post Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Post Failed</span>";
                return $alert;
            }
        }
    }
    public function show_category_post()
    {
        $query = "SELECT * FROM tbl_category_post order by id_cate_post desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatbyId($id)
    {
        $query = "SELECT * FROM tbl_category_post WHERE id_cate_post = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category_post($catName, $catDesc, $catstatus, $id)
    {
        //check validation of user and pass
        $catName = $this->fm->validation($catName);
        $catDesc = $this->fm->validation($catDesc);
        $catStatus = $this->fm->validation($catstatus);

        // mysqli needs 2 varibles
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catDesc = mysqli_real_escape_string($this->db->link, $catDesc);
        $catStatus = mysqli_real_escape_string($this->db->link, $catStatus);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName) || empty($catDesc)) {
            session_start();
            $_SESSION["error"] = "Feilds must not be empty";
            echo "<script>window.location = 'postedit.php?catId=$id'</script>";
            // $alert = "<span class='error'>Category must not be empty</span>";
            // return $alert;
        } else {
            $query = "UPDATE tbl_category_post SET title  = '$catName', description = '$catDesc', status = '$catStatus' 
            WHERE id_cate_post = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $_SESSION["success"] = "Update Category Successfully";
                echo "<script>window.location = 'postedit.php?catId=$id'</script>";
                // $alert = "<span class='success'>Update Category Successfully</span>";
                // return $alert;
            } else {
                $_SESSION["dberror"] = "Update Category Failed";
                echo "<script>window.location = 'postedit.php?catId=$id'</script>";
                // $alert = "<span class='error'>Update Category Failed</span>";
                // return $alert;
            }
        }
    }

    public function del_category_post($id)
    {
        $query = "DELETE FROM tbl_category_post WHERE id_cate_post = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span class='success'>Delete Category Post Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Category Post Failed</span>";
            return $alert;
        }
        return $result;
    }

    public function show_category_frontEnd()
    {
        $query = "SELECT * FROM tbl_category_post order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_by_cat($id)
    {
        $query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_name_by_cat($id)
    {
        $query = "SELECT tp.*, tc.catName, tc.catId 
        FROM tbl_product as tp
        INNER JOIN tbl_category_post as tc
        on tp.catId = tc.catId
        where tp.catId = '$id'
        LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}

?>