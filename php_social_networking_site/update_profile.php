
 <?php
  
  //include 'db_connect.php';
  require 'core.inc.php';

  if(!loggedin())
  {
    header('Location: login_form.php');
  }
  $user_data = getuserfield('*',$link);
  $user_details_col=$user_data['user_details'];

  $userdetails=json_decode($user_details_col);
?>
  <head>
    
    <title>Update Profile</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    
    <style>
      html, body {
      display: flex;
      justify-content: center;
      font-family: Roboto, Arial, sans-serif;
      font-size: 15px;
      }
      form {
      border: 5px solid #f1f1f1;
      }
      input[type=text], input[type=password] {
      width: 100%;
      padding: 16px 8px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      }
      button {
      background-color: #8ebf42;
      color: white;
      padding: 14px 4;
      margin: 10px 3;
      border: none;
      cursor: grabbing;
      width: 100%;
      }
      h1 {
      text-align:center;
      fone-size:18;
      }
      button:hover {
      opacity: 0.8;
      }
      .formcontainer {
      text-align: left;
      margin: 24px 50px 12px;
      }
      .container {
      padding: 16px 0;
      text-align:left;
      }
      span.psw {
      float: right;
      padding-top: 0;
      padding-right: 15px;
      }
      /* Change styles for span on extra small screens */
      @media screen and (max-width: 300px) {
      span.psw {
      display: block;
      float: none;
      }}
    </style>
  </head>
  
  <body>
    <div>
      <button ><a  href="logout.php">Logout</a></button>
    </div>
    <div>
      <button><a href="index.php">Home</a></button>
    </div>
  <center>
  <form action="" method="post">
    <h1>Update Your Profile</h1>
      <div class="formcontainer">
        <hr/>
        <div class="container">
          
          <label ><strong>Email</strong></label>
          <input type="text" placeholder="Enter your Email" name="email" value="<?php
      echo $user_data['email'];?>"required>
      
      <label ><strong>First Name</strong></label>
      <input type="text" placeholder="Enter your First Name" name="first_name" value="<?php echo$userdetails->firstname?>" required>
      
      <label ><strong>Last Name</strong></label>
      <input type="text" placeholder="Enter your Last Name" name="last_name"value="<?php echo$userdetails->lastname?>">
      <h3>Address</h3>
      <label ><strong>building no.</strong></label>
      <input type="text" placeholder="Enter your building/flat no." name="building_no" value="<?php echo$userdetails->building_no?>"required>
        
      <label ><strong>city</strong></label>
      <input type="text" placeholder="Enter your city" name="city" value="<?php echo$userdetails->city?>"required>
      
      <label ><strong>state</strong></label>
      <input type="text" placeholder="Enter your state" name="state" required value="<?php echo$userdetails->state?>">
      
      <label ><strong>country</strong></label>
      <input type="text" placeholder="Enter your country" name="country" value="<?php echo$userdetails->country?>"required>
      </div>
      <button type="submit" name="submit">update</button>   
    </form>
    <?php 
       
       if(isset($_POST['submit'])){
         $id=$user_data['id'];
         
         $first_name=validation($_POST['first_name']);
         $last_name=validation($_POST['last_name']);
         $email=validation($_POST['email']);
            
         $building_no=validation($_POST['building_no']);
         $city=validation($_POST['city']);
         $state=validation($_POST['state']);
         $country=validation($_POST['country']);
         $user_details=array(
           
           'first_name'=>$first_name,
           'last_name'=>$last_name,
           'building_no'=>$building_no,
           'city'=>$city,
           'state'=>$state,
           'country'=>$country,
          );
          
          
          $user_arr=json_encode($user_details);
          $query    = "INSERT into `nf`.`users_update` (member_id, email_update, user_detail_update)
                 VALUES ('$id','$email','$user_arr')";
                if($result=mysqli_query($link, $query)){
                  echo 'your details sent to admin dashboard for approval';
                };
            }

          ?>  
    </body>
  </center>
</html>