<?php
header("Content-type: application/json");
include '../config/conn.php';

function registerUser($conn){
    extract($_POST);
    $data = array();

    $query = " CALL register_user_sp('', '$fullName', '$userType', '$bloodType', '$gmail', '$userName', '$password', '$confirmPass', '$address', '$gender', '$phone') ";

    $result = $conn->query($query);
    if($result){
        $data = array("status" => true, "data" => "Registered SuccessFully ✅");
    }else{
        $data = array("status" => false, "data" => $conn->error);
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

    $query = " UPDATE `users` SET `fullName`='$fullName', `gender`='$gender', `userType`='$userType', `bloodType`='$bloodType', `phone`='$phone', `gmail`='$gmail', `username`='$userName', `address`='$address'  WHERE id = '$id' ";

    $result = $conn->query($query);

    if($result){
        $data = array("status" => true, "data" => "Updated SuccessFully 👌");
    }else{
        $data = array("status" => false, "data" => $conn->error);
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