
<form action="login_form.php" method="POST">
  username:<input type="text" name="username"><br><br>
  password:<input type="text" name="password"><br><br>
  submit:<input type="submit" value="submit">  
</form>
<?php
session_start();
require 'db_connect.php';
$database = 'nf';
mysqli_select_db($link,$database);
?>

<?php
if(isset($_POST['username']) && isset($_POST['password'])){
   
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = md5($password);
    
    
    if(!empty($_POST['username']) && !empty($_POST['password'])){
       
        $query = "SELECT * from `nf`.`users` where `username` = '$username' and `password` ='$password_hash'";
        if($query_run = mysqli_query($link,$query)){
            
            if(mysqli_num_rows($query_run)==1){
                
                $user_data= mysqli_fetch_assoc($query_run);#this is how we acess in array#how to convert it to string?
                $user_id = $user_data['id'];
                 $username1 = $user_data['username'];
                 $password1 = $user_data['password'];
                 $device_status = $user_data['status'];
                 
                 
                
                
                $_SESSION['user_id']= $user_id;
                $_SESSION['username'] = $username1;
                $_SESSION['password'] = $password1;
                $_SESSION['device_status'] = $device_status;
                
               
                
                    header('Location: index.php');
                
                if($username1 == 'admin'){
                    header('Location: adminDashboard.php');
                }
            }
            

            }else{
                echo 'query failed';
            }
        }

    }
    else
    {
        echo'enter username and password';
}

?>