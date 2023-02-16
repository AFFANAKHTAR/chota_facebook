<?php
require 'core.inc.php';

function get_commments($link,$post_id){
            mysqli_select_db($link,'nf');
            $query = "SELECT * FROM `comments` WHERE post_id=$post_id and comment_by= '".$_SESSION['user_id']."'";
            $res = mysqli_query($link,$query);
                if(mysqli_query($link,$query)){
                    //print_r(likes_count($link,$post_id)) ;
                    //header('Location: index.php');
                    return $res;
                }
            }





?>