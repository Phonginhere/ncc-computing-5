<?php
$filepath = realpath(dirname(__FILE__)); 
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class category
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        //check validation of user and pass
        $catName = $this->fm->validation($catName);

        // mysqli needs 2 varibles
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        $duplicate = mysqli_query($this->db->link, "select * from tbl_category where catName ='$catName'");

        if (empty($catName)) {
            $alert = "<span class='error'>Category must not be empty</span>";
            return $alert;
        }elseif(mysqli_num_rows($duplicate) > 0){
            $alert = "<span class='error'>Category already exists</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span class='success'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Category Failed</span>";
                return $alert;
            }
        }
    }
    public function show_category(){
        $query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getcatbyId($id){
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($categoryName, $id){
        $categoryName = $this->fm->validation($categoryName);
        $categoryName = mysqli_real_escape_string($this->db->link, $categoryName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        
        if(empty($categoryName)){
            session_start();
            $_SESSION["error"] = "Category must not be empty";
            echo "<script>window.location = 'catedit.php?catId=$id'</script>";
            // $alert = "<span class='error'>Category must not be empty</span>";
            // return $alert;
        }else{
            $query = "UPDATE tbl_category SET catName  = '$categoryName' WHERE catId = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $_SESSION["success"] = "Update Category Successfully";
                echo "<script>window.location = 'catedit.php?catId=$id'</script>";
                // $alert = "<span class='success'>Update Category Successfully</span>";
                // return $alert;
            } else {
                $_SESSION["dberror"] = "Update Category Failed";
                echo "<script>window.location = 'catedit.php?catId=$id'</script>";
                // $alert = "<span class='error'>Update Category Failed</span>";
                // return $alert;
            }
        }
    }

    public function del_category($id){
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span class='success'>Delete Category Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Category Failed</span>";
            return $alert;
        }
        return $result;
    }

    public function show_category_frontEnd(){
        $query = "SELECT * FROM tbl_category order by catId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_by_cat($id){
        $query = "SELECT * FROM tbl_product where catId = '$id' order by catId desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_name_by_cat($id){
        $query = "SELECT tp.*, tc.catName, tc.catId 
        FROM tbl_product as tp
        INNER JOIN tbl_category as tc
        on tp.catId = tc.catId
        where tp.catId = '$id'
        LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}

?>