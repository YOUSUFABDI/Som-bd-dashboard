<?php
session_start();
header("Content-type: application/json");
include '../config/conn.php';

function registerAdmin($conn){
    extract($_POST);

    $data = array();

    // check if email is taken
    $get_admin_gmail = "SELECT `gmail` FROM `admins` WHERE gmail = '$gmail' ";
    $res_admin_gmail = $conn->query($get_admin_gmail);

    // check if username is taken 
    $get_admin_username = "SELECT `username` FROM `admins` WHERE username = '$username' ";
    $res_admin_username = $conn->query($get_admin_username);

    if(mysqli_num_rows($res_admin_gmail) > 0){
        $data = array("status" => false, "data" => "Sorry that gmail was already taken 😔😔"); 
    }else if(mysqli_num_rows($res_admin_username) > 0){
        $data = array("status" => false, "data" => "Sorry that username was already taken 😔😔"); 
    }else{
        $query = "INSERT INTO `admins`(`gmail`, `username`, `password`) VALUES('$gmail', '$username', '$password')";

        $result = $conn->query($query);
    
        if($result){
            $data = array("status" => true, "data" => "Registered SuccessFully");
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }
    }

    echo json_encode($data);
}

function loginAdmin($conn){
    extract($_POST);

    $data = array();

    $query = " CALL admin_login_sp('$username', '$password')";
    
    $result = $conn->query($query);

    
    if($result){
        $row = $result->fetch_assoc();

        if(isset($row['msg'])){
            if($row['msg'] == 'Deny'){
                $data = array("status" => false, "data" => "Username Or Password Is Incorrect 🙅‍♂️");
            }else{
                $data = array("status" => false, "data" => "User Locked By The Admin");
            }
        }else{
            foreach($row as $key=>$value){
                $_SESSION[$key] = $value;
            }
            $data = array("status" => true, "data" => "Logged In SuccessFully 👌");
        }
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}



if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data" => "Action Required..."));
}
?>