<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class product
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function search_product($tagProduct){
        $tagProduct = $this->fm->validation($tagProduct);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tagProduct%'";
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_product($data, $files)
    {

        // mysqli needs 2 varibles
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
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
            empty($productName) || empty($brand) || empty($category) || empty($productDesc)
            || empty($price) || $type == "Select Type" || empty($file_name)
        ) {
            $alert = "<span class='error'>Feilds must be not empty</span>";
            return $alert;
            // } 
            // elseif (mysqli_num_rows($duplicate) > 0) {
            //     $alert = "<span class='error'>Product already exists</span>";
            //     return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, brandId, catId, productDesc, price, type, image) 
            VALUES ('$productName', '$brand', '$category', '$productDesc', '$price', '$type', '$unique_image')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span class='success'>Insert Product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Product Failed</span>";
                return $alert;
            }
        }
    }

    public function insert_slider($data, $files)
    {
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        //check validation image and put image data into folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div)); //take last character ex: jpg/png format, current: take the name image file
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        
        if (empty($sliderName) && empty($type)) {
            // echo $type. " ".$sliderName;
            // exit();
            $alert = "<span class='error'>Feilds must not be empty</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                //if user chooses image
                if ($file_size > 2000000) {
                    $alert = "<span class='error'>Image size should be less than 20MB!</span>";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='error'>You can upload only: " . implode(', ', $permited) . "!</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);

                    $query = "INSERT INTO tbl_slider(slider_name, type, slider_image) VALUES ('$sliderName', '$type', '$unique_image')";
                    $result = $this->db->insert($query);
                    if ($result == true) {
                        $alert = "<span class='success'>Added Slider Successfully</span>";
                        return $alert;
                    } else {
                        $alert = "<span class='error'>Added Slider Failed</span>";
                        return $alert;
                    }
                }
            }
        }
    }

    public function show_product()
    {
        $query = "SELECT tp.*, tc.catName, tb.brandName
         FROM tbl_product as tp 
         INNER JOIN tbl_category as tc
         on tc.catId = tp.catId
         INNER JOIN tbl_brand as tb 
         on tb.brandId = tp.brandId
         order by productId desc";

        $result = $this->db->select($query);
        return $result;
    }
    public function getproductbyId($id)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_slider(){
        $query = "SELECT * FROM tbl_slider where type='1' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_slider_list(){
        $query = "SELECT * FROM tbl_slider order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_typeslider($id, $type){
        // echo $type." : ".$id;
        // exit();
        $query = "UPDATE tbl_slider SET type='$type' where id = $id";
        $result = $this->db->update($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {

        // mysqli needs 2 varibles
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

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
            empty($productName) || empty($brand) || empty($category) || empty($productDesc)
            || empty($price) || $type == "Select Type"
        ) {
            session_start();
            $_SESSION["error"] = "Product must not be empty";
            echo "<script>window.location = 'productedit.php?productId=$id'</script>";
            // $alert = "<span class='error'>Product must not be empty</span>";
            // return $alert;
        } else {
            if (!empty($file_name)) {
                //if user chooses image
                if ($file_size > 2000000) {
                    $_SESSION["error"] = "<span class='error'>Image size should be less than 20MB!</span>";
                } else if (in_array($file_ext, $permited) === false) {
                    $_SESSION["error"] = "<span class='error'>You can upload only: " . implode(', ', $permited) . "!</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product 
                    SET productName  = '$productName', 
                    catId  = '$category',
                    brandId  = '$brand', 
                    productDesc  = '$productDesc', 
                    type  = '$type', 
                    price  = '$price', 
                    image  = '$unique_image' 
                    WHERE productId = '$id'";
                }
            } else {
                //if user doesn't choose image
                $query = "UPDATE tbl_product SET productName  = '$productName', catId  = '$category', 
                brandId  = '$brand', productDesc  = '$productDesc', type  = '$type', price  = '$price' 
                WHERE productId = '$id'";
            }
            $result = $this->db->update($query);
            if ($result == true) {
                $_SESSION["success"] = "Update Product Successfully";
                echo "<script>window.location = 'productedit.php?productId=$id'</script>";
                // $alert = "<span class='success'>Update Product Successfully</span>";
                // return $alert;
            } else {
                $_SESSION["dberror"] = "Update Product Failed";
                echo "<script>window.location = 'productedit.php?productId=$id'</script>";
                // $alert = "<span class='error'>Update Product Failed</span>";
                // return $alert;
            }
        }
    }

    public function del_slider($id){
        $query = "DELETE FROM tbl_slider WHERE id = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span class='success'>Slider Delete Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Slider Failed</span>";
            return $alert;
        }
        return $result;
    }

    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span class='success'>Product Delete Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Product Failed</span>";
            return $alert;
        }
        return $result;
    }

    public function del_wishlist($proId, $customer_id)
    {
        $query = "DELETE FROM tbl_wishlist WHERE product_id = '$proId' and customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }

    //End back-end
    public function getProduct_feathered()
    {
        $query = "SELECT * FROM tbl_product WHERE type = '1'";
        $result = $this->db->select($query);
        return $result;
    }
    public function getProduct_new()
    {
        $pt_each_page = 4;
        if(!isset($_GET['page'])){
            $page = 1;
        }else{
            $page = $_GET['page'];
        }
        $each_page = ($page - 1)* $pt_each_page;
        $query = "SELECT * FROM tbl_product order by productId desc limit $each_page, $pt_each_page";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_all_product()
    {
        $query = "SELECT * FROM tbl_product";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_details($id)
    {
        $query = "SELECT tp.*, tc.catName, tb.brandName
        FROM tbl_product as tp 
        INNER JOIN tbl_category as tc
        on tc.catId = tp.catId
        INNER JOIN tbl_brand as tb 
        on tb.brandId = tp.brandId
        where tp.productId = '$id'";

        $result = $this->db->select($query);
        return $result;
    }

    public function getLatestDell()
    {
        $query = "SELECT * FROM tbl_product where brandId = '1' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLatestApple()
    {
        $query = "SELECT * FROM tbl_product where brandId = '6' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLatestSamsung()
    {
        $query = "SELECT * FROM tbl_product where brandId = '2' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLatestMadebyBoo()
    {
        $query = "SELECT * FROM tbl_product where brandId = '3' order by productId desc LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_compare($customer_id)
    {
        $query = "SELECT * FROM tbl_compare where customer_id = '$customer_id' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_wishlist($customer_id)
    {
        $query = "SELECT * FROM tbl_wishlist where customer_id = '$customer_id' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompare($productId, $customer_id)
    {

        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $check_compare = "Select * from tbl_compare where product_id = '$productId' AND customer_id = '$customer_id'";
        $result = $this->db->select($check_compare);
        if ($result) {
            $message = "<span class='error'>product Already Added to Compare</span>";
            return $message;
        } else {
            $query = "Select * from tbl_product where productId = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];
            $queryInsert = "INSERT INTO tbl_compare(product_id, price, image, customer_id, productName) 
                VALUES ('$productId', '$price', '$image', '$customer_id', '$productName')";
            $insert_compare = $this->db->insert($queryInsert);
            if ($insert_compare) {
                $alert = "<span class='success'>Added Compare Product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Added Compare Product Failed</span>";
                return $alert;
            }
        }
    }

    public function insertWishlist($productId, $customer_id)
    {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $check_wlist = "Select * from tbl_wishlist where product_id = '$productId' AND customer_id = '$customer_id'";
        $result_check_wlist = $this->db->select($check_wlist);
        if ($result_check_wlist) {
            $message = "<span class='error'>product Already Added to Wishlist</span>";
            return $message;
        } else {
            $query = "Select * from tbl_product where productId = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];
            $queryInsert = "INSERT INTO tbl_wishlist(product_id, price, image, customer_id, productName) 
                VALUES ('$productId', '$price', '$image', '$customer_id', '$productName')";
            $insert_wishlist = $this->db->insert($queryInsert);
            if ($insert_wishlist) {
                $alert = "<span class='success'>Add to wishlist Product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Add to wishlist Product Failed</span>";
                return $alert;
            }
        }
    }

    
}

?>