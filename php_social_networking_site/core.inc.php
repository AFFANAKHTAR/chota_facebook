<?php
session_start();
ob_start();
require 'db_connect.php';

$current_file = $_SERVER['SCRIPT_NAME'];

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
    $http_referer = $_SERVER['HTTP_REFERER'];
}


function loggedin(){
    global $link;
    $query = "SELECT * FROM `nf`.`users` WHERE `id` = '".$_SESSION['user_id']."' ";
    $query_run = mysqli_query($link,$query);
    $res = mysqli_fetch_assoc($query_run);
    $password = $res['password'];

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
        // if(isset($_SESSION['password']) && !empty($_SESSION['password']) && $_SESSION['password'] == $password){
         return true;
        // }
    }else{
        return false;
    }
}

function getuserfield($field,$link){
    if($userid =$_SESSION['user_id']){
    if($query = "SELECT $field from `nf`.`users` where `id`= '$userid'"){
    if($query_run = mysqli_query($link,$query)){
        $result =  mysqli_fetch_assoc($query_run);




        return $result;
    }
}
}
}

function get_all_users($field,$link){
    if($userid =$_SESSION['user_id']){
        if($query="SELECT $field FROM `nf`.`users` WHERE `id`!= $userid"){
            if($res= mysqli_query($link,$query)){
                if($res_data = mysqli_fetch_assoc($res)){
                    return $res_data;
                }
            }
        }
    }
}

function inserttodb($email,$password_hash,$enc_user_details){
    global $link;
   
    $query = "INSERT into `nf`.`users`('email','password','user_details') values('$email','$password_hash','$enc_user_details')";
    if($query_run =mysqli_query($link,$query)){
        header('Location:register_success.php');
    }else{
        echo 'sorry,we couldnt register you at this time try again later.';
    }
}

function checkemail($email){
    global $link;
    $query = "SELECT `email` from `nf`.`users` where `email` = '$email'";
    if($query_run = mysqli_query($link,$query)){
        //echo mysqli_num_rows($query_run);
        if(mysqli_num_rows($query_run)>=1){
            return false;
            echo 'email'.$email.'already exists';
        }else{
            return true;
            //inserttodb($username,$password_hash,$firstname,$lastname);
        }
    }
}

function validation($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


function checkstatus($con){
    $row = mysqli_fetch_assoc(mysqli_query($con,"SELECT `status` from `nf`.`users` where `id` = '".$_SESSION['uid']."' "));
    return $row['status']; 
    }


function show_friend_request($link){
    $query = "SELECT * FROM `nf`.`friend_request` WHERE reciever= '".$_SESSION['user_id']."' ";
    $res = mysqli_query($link,$query);
    if(mysqli_num_rows($res)!=0){
        while($res_data=mysqli_fetch_assoc($res)){
            $sender_id = $res_data['sender'];
            $query = "SELECT * FROM `nf`.`users` WHERE id=$sender_id";
            $res = mysqli_query($link,$query);
            $res_data = mysqli_fetch_assoc($res);
            return $res_data;
        }
    }
}

function on_action_accept($link,$other_id){
    $self_id = $_SESSION['user_id'];
    $query = "INSERT INTO `nf`.`friends`(`user_one`, `user_two`) VALUES ('$self_id','$other_id')";
    if(mysqli_query($link,$query)){
        $query = "DELETE FROM `nf`.`friend_request` WHERE sender = $other_id";
        if(mysqli_query($link,$query)){
            echo "congrats,you are friend with".$other_id;
        }
        
    }
}

function on_action_reject($link,$other_id){
    $query = "DELETE FROM `nf`.`friend_request` WHERE sender = $other_id";
    if(mysqli_query($link,$query)){
        echo 'rejected';
    }
}


function get_all_friends($link){
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM `nf`.`friends` WHERE user_one=$user_id OR user_two=$user_id";
    if($res = mysqli_query($link,$query)){
        while($res_data = mysqli_fetch_assoc($res)){
            if($res_data['user_one'] == $user_id){
                $other_id = $res_data['user_two'];
                $query1 = "SELECT * FROM `nf`.`users` WHERE id=$other_id";
                if($res1 = mysqli_query($link,$query1)){
                    while($res_data1 = mysqli_fetch_assoc($res1)){
                        return $res_data1;
                    }
            }

            }
            else
            {
                $other_id = $res_data['user_one'];
                $query1 = "SELECT * FROM `nf`.`users` WHERE id=$other_id";
                if($res1 = mysqli_query($link,$query1)){
                    while($res_data1 = mysqli_fetch_assoc($res1)){
                        return $res_data1;
                    }
            }    
            }
        }
    }
}

function get_all_friends_post($link){
    $self_id = $_SESSION['user_id'];
    $query = "SELECT * FROM `nf`.`friends` WHERE user_one=$self_id OR user_two=$self_id";
    if($res = mysqli_query($link,$query)){
        if($res_data = mysqli_fetch_assoc($res)){
            
            if($res_data['user_one']==$self_id){
                $other_id = $res_data['user_two'];
                $query1 = "SELECT * FROM `nf`.`image_crud2` join `nf`.`users` ON users.id = image_crud2.member_id
                WHERE `member_id`= '$other_id' AND `post` IN ( 'public','friends')";
                if($res1=mysqli_query($link,$query1)){
                    return $res1;

             }
            }
             else{
                $other_id = $res_data['user_one'];
                $query1 = "SELECT * FROM `nf`.`image_crud2` join `nf`.`users` ON users.id = image_crud2.member_id
                WHERE `member_id`= '$other_id' AND `post` IN ( 'public','friends')";
                    if($res1=mysqli_query($link,$query1)){
                        return $res1;

                    }     
            }


        }
    }
}

// get_all_friends_post($link);


function on_action_unfriend($link,$other_id){
    $query = "DELETE FROM `nf`.`friends` WHERE user_two = $other_id";
    if($res = mysqli_query($link,$query)){
        echo 'succesfully unfriended';
    }
}

function likes_count($link,$post_id){
    mysqli_select_db($link,'nf');
    $query = "SELECT * FROM `likes` WHERE `post_id`=$post_id";
    $res= mysqli_query($link,$query);
    $res_count = mysqli_num_rows($res);
    return $res_count;
    
    } 

    function likes_count1($link,$post_id){
        mysqli_select_db($link,'nf');
        $query = "SELECT * FROM `likes` WHERE `post_id`=$post_id";
        $res= mysqli_query($link,$query);
        $res_count = mysqli_num_rows($res);
        echo $res_count;
        
        }

    function comments_count($link,$post_id){
        mysqli_select_db($link,'nf');
        $query = "SELECT * FROM `comments` WHERE `post_id`=$post_id";
        $res= mysqli_query($link,$query);
        $res_count = mysqli_num_rows($res);
        return $res_count;
        
        }


function get_commments($link,$post_id){
    mysqli_select_db($link,'nf');
    $query = "SELECT * FROM `comments` WHERE post_id=$post_id and comment_by= '".$_SESSION['user_id']."'";
    //$res = mysqli_query($link,$query);
        if($res = mysqli_query($link,$query)){
            if(mysqli_num_rows($res)!=0){
                return $res;
                // $a="";
                // while($res_data = mysqli_fetch_assoc($res)){
                //     $a.= '<p>'.$res_data['comment'].'</p>'.'<button onclick="com_reply_btn($res_data[comment_by], $res_data[post_id])">reply</button>';
                // }
                // return $a;
            }
            else{
                return 0;
            }


            //print_r(likes_count($link,$post_id)) ;
            //header('Location: index.php');
            
        }
    }
?>

<!-- <script>
    function com_reply_btn(comment_by, post_id){
        
    }
</script> -->