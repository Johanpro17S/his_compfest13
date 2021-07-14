<?php
include_once '../init.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $query = "INSERT INTO appointment VALUES(null
        ,'".$_POST['doctor_name']."'
        ,'".$_POST['description']."'
        ,'[]'
        ,'".$_POST['quota']."'
        )";
}elseif($_SERVER['REQUEST_METHOD']=="PUT"){
    parse_str(file_get_contents("php://input"), $put);
    $query = "UPDATE appointment SET doctor_name='".$put['doctor_name']."'
        ,description='".$put['description']."'
        ,quota='".$put['quota']."' 
        WHERE id_app='".$put['app_id']."'";
}elseif($_SERVER['REQUEST_METHOD']=="DELETE"){
    $query = "DELETE FROM appointment WHERE id_app='".$_GET['app_id']."'";
}
mysqli_query($conn,$query);