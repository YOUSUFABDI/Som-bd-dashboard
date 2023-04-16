<?php
header("Content-type: application/json");
include '../config/conn.php';

function getAllUser($conn){
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = " SELECT `id`, `fullName`, `gender`, `userType`, `bloodType`, `phone`, `gmail`, `address` FROM `users` ";

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

function getAllDonors($conn){
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = " SELECT `id`, `fullName`, `gender`, `userType`, `bloodType`, `phone`, `gmail`, `address` FROM `users` WHERE userType = 'Donor'  ";

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

function getAllRecpients($conn){
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = " SELECT `id`, `fullName`, `gender`, `userType`, `bloodType`, `phone`, `gmail`, `address` FROM `users` WHERE userType = 'Recipient'  ";

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

function getAllAppointments($conn){
    extract($_POST);

    $data = array();
    $array_data = array();


    $query = "     SELECT `appointment_id`, `name`, `appintmentDay`, `hospital`, `description` FROM `appointment` ";

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