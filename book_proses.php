<?php

include_once 'init.php';
$session = SessionManager::getCurrentSession();

$data = mysqli_fetch_array(mysqli_query($conn,"SELECT list_patient,quota FROM appointment WHERE id_app='".$_GET['id_app']."'"));
$list = explode(',',substr($data['list_patient'],1,strlen($data['list_patient'])-2));
if (($key = array_search(strval($session->id), $list)) !== false) {
    unset($list[$key]);
}else{
    if(count($list)<$data['quota']){
        array_push($list,strval($session->id));
    }else{
        echo "Quota was fulled";
        return;
    }
}
$list = array_filter($list);
$lp = implode(',',$list);
mysqli_query($conn,"UPDATE appointment SET list_patient='[$lp]' WHERE id_app='".$_GET['id_app']."'");