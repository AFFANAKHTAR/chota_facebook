<?php
require 'core.inc.php';
 

$database = 'nf';
mysqli_select_db($link,$database);

if(!loggedin()){
    header('Location: logout.php');
  }
?>

<?php

include 'header.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </head>
  <body class="bg-light">
  <!-- #read data from database and show it -->
  <div class="container mt-5" >
        <table class="table">
            <thead>
                <tr>
                    <th>name</th>
                    <th>image</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                $fetch_src = fetch_src;
                $query = "SELECT * FROM `nf`.`image_crud2` WHERE `member_id`!= '".$_SESSION['user_id']."'";
                $res1 = mysqli_query($link,$query);
                $res_data1 = mysqli_fetch_assoc($res1);

                if($userid =$_SESSION['user_id']){
                    if($query="SELECT * FROM `nf`.`users` WHERE `id`!= $userid"){
                        if($res= mysqli_query($link,$query)){
                            while($res_data= mysqli_fetch_assoc($res)){
                    
                                echo<<<product
                                    <tr class="align-middle">
                                    <td scope="row">$res_data[username]</td>
                                    <td><img src="$fetch_src$res_data1[image]" width="150px"></td>
                                    <td>
                                    <button type="submit" name="send_request" value="send_request" class="btn btn-primary"><a href="friends_func.php?request_id=$res_data[id]">send request</a></button> 
                                    <button type="submit" name="cancel_request" value="cancel_request" class="btn btn-primary"><a href="friends_func.php?cancel_id=$res_data[id]">cancel request</a></button>        
                                    </td>
                                    </tr>
                                product;
                            }
                        }
                    }
                }
             
                ?>

                <script>
                    function show(element){
                        element.value = 'cancel';
                    }    
                </script>
            </tbody>
        </table>
    </div>
  </body>

<!--<form method= "GET" action="?id=$res_data[id] &update= cancelrequest">
#how to change button valuue onclick through php
<button type="submit" name="send_request" value="<?php echo isset($_GET['update'])? 'Show' : 'Update' ?>" class="btn btn-primary">send request</button>
</form> -->
  