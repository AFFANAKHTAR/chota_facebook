

<?php
require 'core.inc.php';
echo $dir = session_save_path();
// $scanTxt = "user_id|s:". strlen($userId).":".$user_id;
$scanTxt = 'user_id|s:1:"1"';
// $cdir = scandir($dir,0,$scanTxt);
$cdir = shell_exec("grep -rl 'user_id|s:1' ".$dir);
echo ($cdir);die();
// user_id|s:1:"1"

mysqli_select_db($link, 'nf');


// if(!loggedin()){
//     header('Location: logout.php');
// }
$query = "SELECT * FROM `users` WHERE `id` = '".$_SESSION['user_id']."' ";
$query_run = mysqli_query($link,$query);
$res = mysqli_fetch_assoc($query_run);
$password = $res['password'];
$device_status = $res['status'];


if($_SESSION['password'] != $password){
    header('Location: logout.php');
}
if($_SESSION['device_status'] != $device_status){
    header('Location: logout.php');
}


if(isset($_POST['submit'])){
    $password = mysqli_real_escape_string($link,$_POST['password']);
    $old_password = mysqli_real_escape_string($link,$_POST['old_password']);
    $old_password_hash = md5($old_password);
    $new_password_hash = md5($password);
    
    #checking entered old password with password in database

    $query = "SELECT * FROM `nf`.`users` where `password` = '$old_password_hash'  and `id` = '".$_SESSION['user_id']."' ";
    if($query_run = mysqli_query($link,$query)){
        if(mysqli_num_rows($query_run)){
            //password matched now update new password
            $_SESSION['password'] = $new_password_hash;
            $query = "UPDATE `nf`.`users` set `password` = '$new_password_hash' where `id` = '".$_SESSION['user_id']."' ";#without concatenation it will give error
            if($res = mysqli_query($link,$query)){
                $msg = 'password updated';
                echo $msg;
            }

        }
    }else{
        echo 'wrong old password';
    }

    if(isset($_POST['logout'])){
        $query = "SELECT * FROM `users` WHERE `id` = '".$_SESSION['user_id']."' ";
        $query_run = mysqli_query($link,$query);
        $res = mysqli_fetch_assoc($query_run);
        $password = $res['password'];

        $_SESSION['password'] = $password;
        #below all for get logout from logout for all tick
        $query1 = "UPDATE `nf`.`users` SET `status` = '1' WHERE `id` = '".$_SESSION['user_id']."' ";
        if($query_run = mysqli_query($link,$query1)){
            echo 'status updated';
            $query2 = "SELECT * FROM `users` WHERE `id` = '".$_SESSION['user_id']."' ";
            $query_run = mysqli_query($link,$query2);
            $res = mysqli_fetch_assoc($query_run);
            $device_status = $res['status'];
            $_SESSION['device_status'] = $device_status;
        }
        
        #this will fail only for logout for all tickbox
        
    }
   
}
?>


<form action="change_password.php" method="POST">
    <h2>change password</h2>
    old password:<input type="password" name="old_password"><br><br>
    new password:<input type="password" name="password"><br>
    <input type="checkbox" name="logout">logout from all devices<br>
    <input type="submit" value="submit" name="submit">
</form>



<!-- for logout from all devices ,study this (delete all user sessions)
cookie
study session and cookie thoroghly
-->



