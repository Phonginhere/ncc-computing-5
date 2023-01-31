<?php
$filepath = realpath(dirname(__FILE__)); 
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class brand
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_brand($brandName)
    {
        //check validation of user and pass
        $brandName = $this->fm->validation($brandName);

        // mysqli needs 2 varibles
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        $duplicate = mysqli_query($this->db->link, "select * from tbl_brand where brandName ='$brandName'");

        if (empty($brandName)) {
            $alert = "<span class='error'>Brand must not be empty</span>";
            return $alert;
        }elseif(mysqli_num_rows($duplicate) > 0){
            $alert = "<span class='error'>Brand already exists</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span class='success'>Insert Brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Brand Failed</span>";
                return $alert;
            }
        }
    }
    public function show_brand(){
        $query = "SELECT * FROM tbl_brand order by brandId desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getbrandbyId($id){
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($brandName, $id){
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($brandName)){
            session_start();
            $_SESSION["error"] = "Brand must not be empty";
            echo "<script>window.location = 'brandedit.php?brandId=$id'</script>";
        }else{
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $_SESSION["success"] = "Your brand has been updated successfully";
                echo "<script>window.location = 'brandedit.php?brandId=$id'</script>";
                // $alert = "<span class='success'>Update Brand Successfully</span>";
                // echo "<script>window.location = 'brandlist.php?success=Your brand has been updated successfully'</script>";
                // exit();
                // return $alert;
                
            } else {
                $_SESSION["dberror"] = "Update Brand Failed";
                echo "<script>window.location = 'brandedit.php?brandId=$id'</script>";
                // $alert = "<span class='error'>Update Brand Failed</span>";
                // return $alert;
            }
        }
    }

    public function del_brand($id){
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span class='success'>Delete Brand Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Brand Failed</span>";
            return $alert;
        }
        return $result;
    }

    public function show_brand_product($id){
        $query = "SELECT tp.* 
        FROM tbl_product as tp
        INNER JOIN tbl_brand as tb
        on tp.brandId = tb.brandId
        where tb.brandId = '$id'
        order by productId desc";
        $result = $this->db->select($query);
        return $result;
    }

    // public function show_brand_product_all(){
    //     $query = "SELECT tp.* 
    //     FROM tbl_product as tp
    //     INNER JOIN tbl_brand as tb
    //     on tp.brandId = tb.brandId
    //     order by productId desc";
    //     $result = $this->db->select($query);
    //     return $result;
    // }
}

?>