<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class configclass
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function show_config()
    {
        $query = "SELECT * FROM tbl_config";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_config_id()
    {
        $query_id = "SELECT config_id FROM `tbl_config`";
        $result_id = $this->db->select($query_id);
        $followingdata = $result_id->fetch_assoc();
        $id = $followingdata['config_id'];
        return $id;
    }
    public function getconfigbyId($id)
    {
        $query = "SELECT * FROM tbl_config WHERE config_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_config_title_slogan($slogan, $title, $id)
    {
        $slogan = $this->fm->validation($slogan);
        $title = $this->fm->validation($title);

        $slogan = mysqli_real_escape_string($this->db->link, $slogan);
        $title = mysqli_real_escape_string($this->db->link, $title);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($slogan) && empty($title)) {
            session_start();
            $alert = "<span class='error'>Category must not be empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_config SET title_website  = '$title', slogan_website = '$slogan' WHERE config_id = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                // $_SESSION["success"] = "Update Category Successfully";
                // echo "<script>window.location = 'catedit.php?catId=$id'</script>";
                $alert = "<span class='success'>Update Config Successfully</span>";
                return $alert;
            } else {
                // $_SESSION["dberror"] = "Update Category Failed";
                // echo "<script>window.location = 'catedit.php?catId=$id'</script>";
                $alert = "<span class='error'>Update Config Failed</span>";
                return $alert;
            }
        }
    }

    public function update_config_social_media($facebook, $twitter, $pinterest, $email, $id)
    {
        $facebook = $this->fm->validation($facebook);
        $twitter = $this->fm->validation($twitter);
        $pinterest = $this->fm->validation($pinterest);
        $email = $this->fm->validation($email);

        $facebook = mysqli_real_escape_string($this->db->link, $facebook);
        $twitter = mysqli_real_escape_string($this->db->link, $twitter);
        $pinterest = mysqli_real_escape_string($this->db->link, $pinterest);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($facebook) || empty($twitter) || empty($pinterest) || empty($email)) {
            $alert = "<span class='error'>Feilds must not be empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_config SET social_twitter  = '$twitter', 
            social_facebook = '$facebook', social_mail = '$email', social_pinterest = '$pinterest' 
            WHERE config_id = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $alert = "<span class='success'>Update Config Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Config Failed</span>";
                return $alert;
            }
        }
    }

    public function update_config_copyright($copyright, $id)
    {
        $copyright = $this->fm->validation($copyright);

        $copyright = mysqli_real_escape_string($this->db->link, $copyright);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($copyright)) {
            $alert = "<span class='error'>Feild must not be empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_config SET copyright_text = '$copyright' WHERE config_id = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $alert = "<span class='success'>Update Config Copyright Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Config Copyright Failed</span>";
                return $alert;
            }
        }
    }
    public function update_config_phoneandfax($phone, $fax, $id)
    {
        $phone = $this->fm->validation($phone);
        $fax = $this->fm->validation($fax);

        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $fax = mysqli_real_escape_string($this->db->link, $fax);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($phone) || empty($fax)) {
            $alert = "<span class='error'>Feilds must not be empty</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_config SET phone_num = '$phone', fax_num = '$fax' WHERE config_id = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $alert = "<span class='success'>Update Config Phone/Fax Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Config Phone/Fax Failed</span>";
                return $alert;
            }
        }
    }
    public function update_config_image($files, $id)
    {
        //check validation image and put image data into folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div)); //take last character ex: jpg/png format, current: take the name image file
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (!empty($file_name)) {
            //if user chooses image
            if ($file_size > 2000000) {
                // echo $unique_image . " & " . $file_name . " error";
                // exit();
                $alert = "<span class='error'>Image size should be less than 20MB!</span>";
                return $alert;
            } else if (in_array($file_ext, $permited) === false) {
                // echo $unique_image . " & " . $file_name . " error2 ";
                // exit();
                $alert = "<span class='error'>You can upload only: " . implode(', ', $permited) . "!</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_config
                SET 
                image_main_web  = '$unique_image' 
                WHERE config_id = '$id'";
                $result = $this->db->update($query);
                if ($result == true) {
                    $alert = "<span class='success'>Update Config image Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Update Config image Failed</span>";
                    return $alert;
                }
            }
        }
    }
}

?>