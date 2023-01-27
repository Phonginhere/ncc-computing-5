<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class page
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_page($data)
    {

        // mysqli needs 2 varibles
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $page_content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $data['type']);
        $slug = $this->fm->create_slug($title);
        $duplicate = mysqli_query($this->db->link, "select * from tbl_page where page_title ='$title'");
        // echo $title." oke: ".$page_content." haha: ".$status;
        // exit();
        if (
            empty($title) || empty($page_content) || $status == "Select Status"
        ) {
            $alert = "<span class='error'>Feilds must be not empty</span>";
            return $alert;
        } elseif (mysqli_num_rows($duplicate) > 0) {
            $alert = "<span class='error'>Page title already exists</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_page(page_title, page_content, status, slug) 
            VALUES ('$title', '$page_content', '$status', '$slug')";
            $result = $this->db->insert($query);
            if ($result == true) {
                $alert = "<span class='success'>Insert Page Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Page Failed</span>";
                return $alert;
            }
        }
    }



    public function show_page()
    {
        $query = "SELECT *
         FROM tbl_page
         order by page_id desc";

        $result = $this->db->select($query);
        return $result;
    }
    public function getpagebyId($id)
    {
        $query = "SELECT * FROM tbl_page WHERE page_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_page($data, $id)
    {

        // mysqli needs 2 varibles
        $title = mysqli_real_escape_string($this->db->link, $data['title']);
        $page_content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);
        $slug = $this->fm->create_slug($title);

        if (
            empty($title) || empty($page_content) || $status == "Select Status"
        ) {
            $alert = "<span class='error'>Page news must not be empty</span>";
            return $alert;
        } else {
            //if user doesn't choose image
            $query = "UPDATE tbl_page SET page_title  = '$title', page_content  = '$page_content', 
                status  = '$status', 
                slug  = '$slug' 
                WHERE page_id = '$id'";
            $result = $this->db->update($query);
            if ($result == true) {
                $alert = "<span class='success'>Update page Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update page Failed</span>";
                return $alert;
            }
        }
    }

    public function del_page($id)
    {
        $query = "DELETE FROM tbl_page WHERE page_id = '$id'";
        $result = $this->db->delete($query);
        if ($result == true) {
            $alert = "<span class='success'>Page Delete Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Page Failed</span>";
            return $alert;
        }
        return $result;
    }

    //End back-end
    public function page_slug_display($slug){
        $query = "SELECT * FROM tbl_page WHERE slug = '$slug'";
        $result = $this->db->select($query);
        return $result;
    }
}

?>