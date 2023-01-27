<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class customer
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_comment(){
        $product_id = $_POST['product_id_comment'];
        $nameComment = $_POST['namepersonComment'];
        $comment = $_POST['comment'];
        if($nameComment == '' && $comment == ''){
            $alert = "<span class='error'>Feilds must be not empty</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_comment(comment_title, comment_detail, product_id) 
            VALUES ('$nameComment', '$comment', '$product_id')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span class='success'>Comment will be censored by admin</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Comment created Failed</span>";
                return $alert;
            }
        }

    }

    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if (
            empty($name) || empty($password) || empty($city) || empty($email) || empty($address)
            || empty($zipcode) || empty($country) || $country == "Select a Country" || empty($phone)
        ) {
            $alert = "<span class='error'>Feilds must be not empty</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span class='error'>Email already existed</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer(name, address, city, country, zipcode, phone, email, password) 
                VALUES ('$name', '$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";
                $result = $this->db->insert($query);
                if ($result == true) {
                    $alert = "<span class='success'>Customer created Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Customer created Failed</span>";
                    return $alert;
                }
            }
        }
    }

    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if (
            empty($password) || empty($email)
        ) {
            $alert = "<span class='error'>Email and Password must be not empty</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' and password='$password' LIMIT 1";
            $result_check = $this->db->select($check_login);
            if ($result_check) {
                $value = $result_check->fetch_assoc();
                // echo $value['id'];
                // exit();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                // header('Location: order.php');
                $script = "<script>
                window.location = 'order.php';</script>";
                echo $script;
            } else {
                $alert = "<span class='error'>Invaid Email or/and Password</span>";
                return $alert;
            }
        }
    }

    public function show_customers($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id='$id'";
        $result_check = $this->db->select($query);
        return $result_check;
    }

    public function update_customer($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if (
            empty($name) || empty($email) || empty($address) || empty($zipcode) || empty($phone)
        ) {
            $alert = "<span class='error'>Feilds must be not empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_customer 
            SET name = '$name', address = '$address', zipcode = '$zipcode', phone = '$phone', email = '$email' 
            WHERE id = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $alert = "<span class='success'>Customer updated Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Customer updated Failed</span>";
                return $alert;
            }
        }
    }
    
}

?>