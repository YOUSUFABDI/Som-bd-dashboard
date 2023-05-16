<?php
header("Content-type: application/json");
include '../config/conn.php';

function registerUser($conn){
    extract($_POST);
    $data = array();

    // check if gmail is taken
    $get_reg_user_gmail = "SELECT `gmail` FROM `users` WHERE gmail = '$gmail' ";
    $res_reg_user_gmail = $conn->query($get_reg_user_gmail);

    // check if username is taken
    $get_reg_user_username = "SELECT `username` FROM `users` WHERE username = '$userName' ";
    $res_reg_user_username = $conn->query($get_reg_user_username);

    // check if phone is taken
    $get_reg_user_phone = "SELECT `phone` FROM `users` WHERE phone = '$phone' ";
    $res_reg_user_phone = $conn->query($get_reg_user_phone);

    if(mysqli_num_rows($res_reg_user_phone) > 0){
        $data = array("status" => false, "data" => "Sorry that phone number was already taken 😔😔"); 
    }else if(mysqli_num_rows($res_reg_user_gmail) > 0){
        $data = array("status" => false, "data" => "Sorry that gmail was already taken 😔😔");
    }else if(mysqli_num_rows($res_reg_user_username) > 0){
        $data = array("status" => false, "data" => "Sorry that username was already taken 😔😔");
    }else{
        $query = " CALL register_user_sp('', '$fullName', '$userType', '$bloodType', '$gmail', '$userName', '$password', '$address', '$gender', '$phone') ";
    
        $result = $conn->query($query);
        if($result){
            $data = array("status" => true, "data" => "Registered SuccessFully ✅");
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }
    }

    echo json_encode($data);
}

function getAllUser($conn){
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = " SELECT `id`, `fullName`, `gender`, `userType`, `bloodType`, `phone`, `gmail`, `username`, `address` FROM `users` ";

    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $array_data [] = $row;
        }

        $data = array("status" => true, "data" => $array_data);
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function updateUserInfo($conn){
    extract($_POST);

    $data = array();

    // check if phone is taken
    $get_reg_user_phone = "SELECT `phone` FROM `users` WHERE phone = '$phone' ";
    $res_reg_user_phone = $conn->query($get_reg_user_phone);

    // check if gmail is taken
    $get_reg_user_gmail = "SELECT `gmail` FROM `users` WHERE gmail = '$gmail' ";
    $res_reg_user_gmail = $conn->query($get_reg_user_gmail);
    
    // check if username is taken
    $get_reg_user_username = "SELECT `username` FROM `users` WHERE username = '$userName' ";
    $res_reg_user_username = $conn->query($get_reg_user_username);

    if(mysqli_num_rows($res_reg_user_phone) > 0){
        $data = array("status" => false, "data" => "Sorry that phone number was already taken 😔😔");
    }else if(mysqli_num_rows($res_reg_user_gmail) > 0){
        $data = array("status" => false, "data" => "Sorry that gmail was already taken 😔😔");
    }else if(mysqli_num_rows($res_reg_user_username) > 0){
        $data = array("status" => false, "data" => "Sorry that username was already taken 😔😔");
    }else{
        $query = " UPDATE `users` SET `fullName`='$fullName', `gender`='$gender', `userType`='$userType', `bloodType`='$bloodType', `phone`='$phone', `gmail`='$gmail', `username`='$userName', `address`='$address'  WHERE id = '$id' ";
    
        $result = $conn->query($query);
    
        if($result){
            $data = array("status" => true, "data" => "Updated SuccessFully 👌");
        }else{
            $data = array("status" => false, "data" => $conn->error);
        }
    }

    echo json_encode($data);
}

function getUserInfo($conn){
    extract($_POST);

    $data = array();

    $query = " SELECT * FROM `users` WHERE id = '$id'";

    $result = $conn->query($query);

    if($result){
        $row = $result->fetch_assoc();

        $data = array("status" => true, "data" => $row);
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function deleteUser($conn){
    extract($_POST);

    $data = array();

    $query = " DELETE FROM `users` WHERE id = '$id' ";

    $result = $conn->query($query);

    if($result){
        $data = array("status" => true, "data" => "Deleted SuccessFully 😔");
    }else{
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

function searchName($conn){
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = " SELECT  `id`, `fullName`, `gender`, `userType`, `bloodType`, `phone`, `gmail` FROM `users` WHERE fullName = '$name' ";

    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $array_data [] = $row;
        }

        $data = array("status" => true, "data" => $array_data);
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