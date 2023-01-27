<?php
$filepath = realpath(dirname(__FILE__)); 
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
class user
{
    private $db; //only use this $db varible in the class that have $db varible;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
}

?>