<?php
require 'core.inc.php';

mysqli_select_db($link,'nf');

// function likes_count($link,$post_id){
//     mysqli_select_db($link,'nf');
//     $query = "SELECT * FROM `likes` WHERE `post_id`=$post_id";
//     $res= mysqli_query($link,$query);
//     $res_count = mysqli_num_rows($res);
//     return $res_count;
    
//     } 

if( isset($_GET['post_id'])){
    $post_id =  $_GET['post_id'];
    $other_id = '3';
        mysqli_select_db($link,'nf');
        $query = "SELECT * FROM `likes` WHERE post_id=$post_id and user_one= '".$_SESSION['user_id']."'";
        $res = mysqli_query($link,$query);
        if(mysqli_num_rows($res)===0){
            $query = "INSERT INTO `likes`(`user_one`, `user_two`,`post_id`) VALUES ('$_SESSION[user_id]','$other_id','$post_id')";
            if(mysqli_query($link,$query)){
                print_r(likes_count($link,$post_id)) ;
                //header('Location: index.php');
                //return 1;
            }
        }else{
            $query = "DELETE FROM `likes` WHERE post_id=$post_id and user_one= '".$_SESSION['user_id']."'";
            if(mysqli_query($link,$query)){
                 print_r(likes_count($link,$post_id));#this not working for 2nd or third post
                //header('Location: index.php');
                //return 1;
            }
            
        }


      }




?>