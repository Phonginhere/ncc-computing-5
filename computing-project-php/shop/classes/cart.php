<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class cart
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId = session_id();

        $query = "Select * from tbl_product where productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();
        $rsImage = $result['image'];
        $rsPrice = $result['price'];
        $rsProName = $result['productName'];

        // $checkCart = "Select * from tbl_cart where productId = '$id' AND sId = '$sId'";
        // $result = $this->db->select($checkCart);
        // echo $result;
        // exit();
        // if ($result) {
        //     $message = "product Already Added";
        //     return $message;
        // } else {
            $queryInsert = "INSERT INTO tbl_cart(productId, quantity, sId, image, price, productName) 
            VALUES ('$id', '$quantity', '$sId', '$rsImage', '$rsPrice', '$rsProName')";
            $insert_cart = $this->db->insert($queryInsert);
            if ($insert_cart) {
                header('Location:cart.php');
            } else {
                header('Location:404.php');
            }
        // }
    }

    public function get_product_cart()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_quantity_cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET quantity  = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            header('Location: cart.php');
        } else {
            $message = "<span class='error'>product Quantity Updated Fail</span>";
            return $message;
        }
    }

    public function del_product_cart($cartId){
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location: cart.php');
        } else {
            $message = "<span class='error'>product Quantity Deleted Fail</span>";
            return $message;
        }
    }

    public function check_cart(){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function check_order($customer_id){
        $sId = session_id();
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_all_data_cart(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->delete($query);
        return $result; 
    }

    public function del_compare($customer_id){
        $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result; 
    }
    
    public function insertOrder($customer_id){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $get_product = $this->db->select($query);
        if($get_product){
            while($result = $get_product->fetch_assoc()){
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customer_id = $customer_id;

                $query_order = "INSERT INTO tbl_order(productId, productName, customerId, quantity, price, image) 
                VALUES ('$productId', '$productName', '$customer_id', '$quantity', '$price', '$image')";
                $insert_order = $this->db->insert($query_order);    
            }
        }
    }

    public function get_amount_price($customer_id){
        $query = "SELECT price FROM tbl_order WHERE customerId = '$customer_id'";
        $get_price = $this->db->select($query);
        return $get_price;
    }

    public function get_cart_ordered($customerId){
        $query = "SELECT * FROM tbl_order WHERE customerId = '$customerId'";
        $get_cart_ordered = $this->db->select($query);
        return $get_cart_ordered;
    }

    public function get_inbox_cart(){
        $query = "SELECT * FROM tbl_order order by date_order";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }

    public function shifted($id, $time, $price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET status  = '1' WHERE id = '$id' and date_order = '$time' and price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $message = "<span class='success'>Updated Order Successfully</span>";
            return $message;
        } else {
            $message = "<span class='error'>Updated Order Fail</span>";
            return $message;
        }
    }

    public function del_shifted($id, $time, $price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM tbl_order WHERE id = '$id' and date_order = '$time' and price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $message = "<span class='success'>Delete Order Successfully</span>";
            return $message;
        } else {
            $message = "<span class='error'>Delete Order Fail</span>";
            return $message;
        }
    }

    public function shifted_confirm($id, $time, $price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET status  = '2' WHERE customerId = '$id' and date_order = '$time' and price = '$price'";
        $result = $this->db->update($query);
        return $result;
    }
}

?>