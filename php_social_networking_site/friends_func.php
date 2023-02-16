<?php
require 'core.inc.php';
if(isset($_GET['request_id'])){
    $reciever_id = $_GET['request_id'];
    $sender_id = $_SESSION['user_id'];

    $query = "INSERT INTO `nf`.`friend_request` (`sender`, `reciever`) VALUES ('$sender_id','$reciever_id')";
    $res = mysqli_query($link,$query);
     
}

if(isset($_GET['cancel_id'])){
    $reciever_id = $_GET['cancel_id'];
    $sender_id = $_SESSION['user_id'];

    $query = "DELETE FROM `nf`.`friend_request` WHERE reciever=$reciever_id";
    $res = mysqli_query($link,$query);
     
}



?>