<?php
header("Content-type: application/json");
include '../config/conn.php';

function getAllAppointments($conn){
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = " SELECT * FROM `appointment` ";

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

function searchAppointmentDay($conn){
    extract($_POST);

    $data = array();
    $array_data = array();

    $query = " SELECT  `id`, `name`, `appintmentDay`, `hospital`, `description`, `phone` FROM `appointment` WHERE phone = '$phone' ";

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