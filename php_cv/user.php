<?php 
// connect to database


function getUserByUserName($username, $db){
    $sql = "SELECT * FROM users WHERE username = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute([$username]);

    if($stmt->num_rows == 0){
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();
        // $array = array($user);
        // echo "Array contents: ";
        // print_r($array);
        // exit();
        return $user;
    }else {
        return 0;
    }
}

 ?>