<html>
    hi
</html>
<?php
require 'core.inc.php';

mysqli_select_db($link,'nf');

if(isset($_GET['other_id']) && isset($_GET['post_id'])){
    $other_id = $_GET['other_id'];
    $post_id =  $_GET['post_id'];
    
        mysqli_select_db($link,'nf');
        $query = "SELECT * FROM `likes` WHERE post_id=$post_id and user_one= '".$_SESSION['user_id']."'";
        $res = mysqli_query($link,$query);
        if(mysqli_num_rows($res)==0){
            $query = "INSERT INTO `likes`(`user_one`, `user_two`,`post_id`) VALUES ('$_SESSION[user_id]','$other_id','$post_id')";
            if(mysqli_query($link,$query)){
                header('Location: index.php');
                //return 1;
            }
        }else{
            $query = "DELETE FROM `likes` WHERE post_id=$post_id and user_one= '".$_SESSION['user_id']."'";
            if(mysqli_query($link,$query)){
                header('Location: index.php');
                //return 1;
            }
            
        }


      }
    
    
    
    
  
  
  
  
?>
<!-- #one post one like -->
<!-- #ajax ke through karte hai -->