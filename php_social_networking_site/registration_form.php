<?php
//require 'db_connect.php';
require 'core.inc.php';
?>

<form action="registration_form.php" method="POST">
username:<br>
<input type="text" name="username" value="<?php echo $username?>"><br>
email:<br><input type="text" name="email" value="<?php echo $email?>"><br>
password:<br><input type="password" name="password"><br>
password again:<br><input type="password" name="password_again"><br><br>
firstname:<br><input type="text" name="firstname" value="<?php echo $firstname?>"><br>
lastname:<br><input type="text" name="lastname" value="<?php echo $lastname?>"><br><br>
buiding_no:<br><input type="text" name="building_no" value="<?php echo $building_no?>"><br><br>
city:<br><input type="text" name="city" value="<?php echo $city?>"><br><br>
state:<br><input type="text" name="state" value="<?php echo $state?>"><br><br>
country:<br><input type="text" name="country" value="<?php echo $country?>"><br><br>
image:<br><input type="file" name="file" ><br><br>
<input type="submit" value="register">
</form>

<?php
// if(!loggedin()){
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['firstname']) && 
    isset($_POST['lastname'])){
        //echo 'pkay1';
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_again = $_POST['password_again'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $building_no = $_POST['building_no'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];

        $password_hash = md5($password);

        $user_details = array(
            "firstname" => "$firstname",
            "lastname" => "$lastname",
            'building_no'=>$building_no,
            'city'=>$city,
            'state'=>$state,
            'country'=>$country,
        );

        if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_again']) && !empty($_POST['firstname'])
        && !empty($_POST['lastname'])){
            if($password != $password_again){
                echo 'password do  not match';
            }elseif(checkemail($email)){
                
                $enc_user_details = json_encode($user_details);
                
                $query = "INSERT into `nf`.`users`(username,email,password,user_details) values('$username','$email','$password_hash','$enc_user_details')";
                if($query_run =mysqli_query($link,$query)){
                    header('Location:register_success.php');
                }else{
                    echo 'sorry,we couldnt register you at this time try again later.';
                }
                //inserttodb($email,$password_hash,$enc_user_details);
                //echo 'password matched,start registration process';
                
            }

            //echo 'ok';

        }
        else{
            echo 'all fields are required';
        }
    }

//  }
// else{
//     echo 'you\'re already registered go log in yourself';
// }
?>



<!-- <?php
// else if(loggedin()){

// }
?> -->