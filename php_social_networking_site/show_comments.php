<?php
require 'core.inc.php';
mysqli_select_db($link,'nf');
if(isset($_GET['post_id']) && isset($_GET['comment'])){
    $postid = $_GET['post_id'];
    $comment = $_GET['comment']; 

    $query = "INSERT INTO `comments`(`comment_by`, `post_id`, `comment`) VALUES ('$_SESSION[user_id]','$postid','$comment')";
    if(mysqli_query($link,$query)){
        $get_all_comments = get_commments($link,$postid);
        while($comment_data = mysqli_fetch_assoc($get_all_comments)){
            echo("<p>".$comment_data['comment']."</p>".'<button commentID="'.$comment_data['id'].'" onclick= "reply(this)">reply</button>'."<br>");
        }
        
    }
}
?>





