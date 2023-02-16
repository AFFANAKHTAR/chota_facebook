<?php
require 'core.inc.php';
$member_id = $_GET['id'];
$action = $_GET['action'];

// $query = "SELECT * FROM `nf`.`users2` WHERE id = $member_id";
// $query_run = mysqli_query($link,$query);
// $res = mysqli_fetch_assoc($query_run);
// $user_update_col = $res['user_details'];
// $user_details = json_decode($user_update_col);

// $query = "SELECT * FROM `nf`.`users_update2` WHERE member_id = $member_id";
// $query_run = mysqli_query($link,$query);
// $res1 = mysqli_fetch_assoc($query_run);
// $user_update_col1 = $res1['user_detail_update'];
// $user_details1 = json_decode($user_update_col1);
// $username = $res['username'];
// $email = $res['email'];
// $user_

// $username = $res1['username'];



#transferrign data from users_update2 to users2[original table]

if($action == 'approve'){
    $query = "UPDATE `nf`.`users` as u SET email = (SELECT email_update FROM `nf`.`users_update` WHERE u.id = $member_id ), 
    user_details = (SELECT user_detail_update FROM `nf`.`users_update` WHERE u.id = $member_id)";
    if($query_run = mysqli_query($link,$query)){
        echo 'ok';
    }
    echo 'approved';

}
else{

$query = "DELETE FROM `nf`.`users_update` WHERE member_id = $member_id";
if($query_run = mysqli_query($link,$query)){
    echo 'rejected';
}

}
?>