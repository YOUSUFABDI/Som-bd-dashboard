<?php
session_start();
header("Content-type: application/json");
include '../config/conn.php';

function registerAdmin($conn){
    extract($_POST);

    $data = array();

    $query = "INSERT INTO `admins`(`gmail`, `username`, `password`) VALUES('$gmail', '$username', '$password')";

    $result = $conn->query($query);

    if($result){
        $data = array("status" => true, "data" => "Registered SuccessFully");
    }else{
        $data = array("status" => false, "data" => $conn->error);
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