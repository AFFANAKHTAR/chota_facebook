<?php
require 'core.inc.php';
$database = 'nf';
mysqli_select_db($link,$database);
?>

<?php
include 'header.php';
?>

<?php
  $user_data = getuserfield('*',$link);
  $user_details_col=$user_data['user_details'];

$userdetails=json_decode($user_details_col);
?>

<center>
<div>

<a href="../login2/uploading_files2.php">
  
  <img style="
vertical-align: middle;
width: 250px;
height: 250px;
border-radius: 50%;
" src="img/guest-user.png" alt="">
</a>  
</div>
  <div>
    
    <h1><?php echo $user_data['username']?></h1><br><br><hr>
  </div>
  <div>

    <h2>Your Profile</h3>
    <hr>
    <h3 style="color:blue;">User Info</h3>
    <p><strong>
      First Name :
      
    </strong> 
    <?php print_r($userdetails->firstname);?>

  </p>

    <p>
      <strong>
        Last Name:
        </strong>
        <?php print_r($userdetails->lastname);?></p>
    <p>
      <strong>
        Email:
        </strong>
        <?php echo $user_data['email'];?></p>
    
    <h3 style="color:blue;"
    >Your Address</h3>
    
    <p> 
    <strong>
      Building No. :
    </strong><?php print_r($userdetails->building_no);?></p>

    <p>
      <strong>
        City :
      </strong>
      <?php print_r($userdetails->city);?></p>
    <p>
      <strong>
        State :
      </strong><?php print_r($userdetails->state);?></p>
    <p>
      <strong>
        Country
      </strong><?php print_r($userdetails->country);?></p>
  </div>
  
  <button style="  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;"><a style="color:white; font-size:16px; text-decoration: none;"  href="update_profile.php">Update Profile </a></button>
  <button style="  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;"
  ><a style="color:white; font-size:16px; text-decoration: none;" href='change_password.php'>Change Password</a></button>
</center>