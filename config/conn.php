<?php

$conn = new mysqli("localhost", "root", "", "som-blood-donation");
if($conn->connect_error){
    echo $conn->error;
}

?>