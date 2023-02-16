
<?php

// require 'db_connect.php';
require 'core.inc.php';
//require 'likes.php';
$database = 'nf';
mysqli_select_db($link,$database);
$fetch_src = fetch_src;

if(!loggedin()){
    header('Location: logout.php');
  }
  $user_data = getuserfield('*',$link);
  $user_details_col=$user_data['user_details'];

$userdetails=json_decode($user_details_col);

#functions 

  

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
        <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<style>
#myDIV {
  width: 100%;
  padding: 50px 0;
  text-align: center;
  background-color: lightblue;
  margin-top: 20px;
}

.all_comments{
    height: 150%;
    overflow-y: scroll;
    word-wrap: break-word;
}
      body {
    background:#eee;
}
.posts-content{
    margin-top:20px;    
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}
.default-style .ui-bordered {
    border: 1px solid rgba(24,28,33,0.06);
}
.ui-bg-cover {
    background-color: transparent;
    background-position: center center;
    background-size: cover;
}
.ui-rect {
    padding-top: 50% !important;
}
.ui-rect, .ui-rect-30, .ui-rect-60, .ui-rect-67, .ui-rect-75 {
    position: relative !important;
    display: block !important;
    padding-top: 100% !important;
    width: 100% !important;
}
.d-flex, .d-inline-flex, .media, .media>:not(.media-body), .jumbotron, .card {
    -ms-flex-negative: 1;
    flex-shrink: 1;
}
.bg-dark {
    background-color: rgba(24,28,33,0.9) !important;
}
.card-footer, .card hr {
    border-color: rgba(24,28,33,0.06);
}
.ui-rect-content {
    position: absolute !important;
    top: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    left: 0 !important;
}
.default-style .ui-bordered {
    border: 1px solid rgba(24,28,33,0.06);
}
</style>
</head>

  <body class="bg-light">
  <!-- #read data from database and show it -->
  <div class="container mt-5">
  <div class="container posts-content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
              <div class="card-body">
                <?php
              //   function createCommentRow($data) {
              //     global $link;

              //     $response = '
              //             <div class="comment">
                              
              //                 <div class="userComment">'.$data['comment'].'</div>
              //                 <div class="reply"><a href="javascript:void(0)" data-commentID="'.$data['id'].'" onclick="reply(this)">REPLY</a></div>
              //                 <div class="replies">';

              //     $sql = $link->query("SELECT replies.id, name, comment FROM replies INNER JOIN users ON replies.user_id = users.id WHERE replies.comment_id = '".$data['id']."' ORDER BY replies.id DESC LIMIT 1");
              //     while($dataR = $sql->fetch_assoc())
              //         $response .= createCommentRow($dataR);

              //     $response .= '
              //                         </div>
              //             </div>
              //         ';

              //     return $response;
              // }

              


                if($res = get_all_friends_post($link)){
                  while ($res_data= mysqli_fetch_assoc($res)){
                    $postid = $res_data['post_id'];
                    $likes =likes_count($link,$postid);
                    $all_comments = get_commments($link,$postid);
                    $response="";

                    
                      while($res_data1 = mysqli_fetch_assoc($all_comments)){
                         $response.= '<p>'.$res_data1['comment'].'</p>'.'<button commentID="'.$res_data1['id'].'" onclick= "reply(this)">reply</button>';
                        //$response.= createCommentRow($res_data1);
                      }


                    echo<<<product

                      <div class="media mb-3">
                        <img src="$fetch_src$res_data[image]" class="d-block ui-w-40 rounded-circle" alt="">
                          <div class="media-body ml-3">
                            $res_data[username];
                            <div class="text-muted small">3 days ago</div>
                          </div>
                      </div>
                          
                        <p>$res_data[description]</p>
                        <img src="$fetch_src$res_data[image]" alt="post" class="background-image" style="width:100%;height:100%;">

                        <div class="card-footer">
                          <button id="btnclick" onclick="buttonclickhandler($postid)"><strong id="show-$postid">$likes</strong> Likes</small></button>
                           
                          
                          
                          <button id="btnclickcom" onclick="showdiv($postid)">comments</button>

                          <div id="commentbox-$postid" style="display:none" class="container">
                          
                          
                          <div id="youroutputdiv-$postid" class="all_comments">
                          $response

                          </div> 
                          <div id="comment_form">
                          <form id="comment_form1">
                          <input type="text" id="add_comment-$postid">
                          <button type="button" name="post" onclick="showrecentcomment($postid)">post</button>
                          </form>
                          </div> 
                          <strong></strong>Comments</small>
                          </div>

                        
                          <a href="javascript:void(0)" class="d-inline-block text-muted ml-3">
                          <small class="align-middle">Repost</small>
                          </a>


                              
                          

                        </div>


                          
                    product;

                  
                    }

                  }

                  
                ?>

 
                <div class="row replyRow" style="display:none">
                    <div class="col-md-12">
                        <textarea class="form-control" id="replyComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
                        <button style="float:right" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
                        <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button>
                    </div>
                </div>
                <script>

                  function showrecentcomment(postid){
                    var results = document.getElementById("add_comment-"+postid).value;
                    document.getElementById("add_comment-"+postid).value = "";
                    
                    const xhr = new XMLHttpRequest();

                    //document.getElementById("youroutputdiv-"+postid).innerHTML = results;
                    xhr.onload = function() {
                      // Here you can use the Data
                      document.getElementById("youroutputdiv-"+postid).innerHTML = this.responseText;
                    }
                    
                    xhr.open('GET','show_comments.php?post_id='+postid+'&comment='+results,true);

                    xhr.send();
                  }

                  
                  
                  function showdiv(postid){
            
                    var x = document.getElementById("commentbox-"+postid);

                    //  x.onload() = 
                    if (x.style.display === "none") {
                      x.style.display = "block";
                    } else {
                      x.style.display = "none";
                    }


                  }
                  


                  function buttonclickhandler_com(post_id){
                    //instantiate an xhr object
                    const xhr = new XMLHttpRequest();
                    // Define a callback function
                    xhr.onload = function() {
                      // Here you can use the Data
                      document.getElementById("showcom-"+post_id).innerHTML = this.responseText;
                    }
                    //open the object
                    xhr.open('GET','show_comments.php?post_id='+post_id,true);

                    

                    
                    //send the request
                    xhr.send();
                  }



                  
   
                  function buttonclickhandler(post_id){
                   
                    //instantiate an xhr object
                    const xhr = new XMLHttpRequest();
                    // Define a callback function
                    xhr.onload = function() {
                      // Here you can use the Data
                      document.getElementById("show-"+post_id).innerHTML = this.responseText;
                    }
                    //open the object
                    xhr.open('GET','likes1.php?post_id='+post_id,true);

                    

                    
                    //send the request
                    xhr.send();
                  }

                  function reply(caller){
                    commentID = $(caller).attr('commentID');
                    $(".replyRow").insertAfter($(caller));
                    $('.replyRow').show();
                  }
                </script>
              </div>
            </div>
        </div>
       
      </div>
    </div>
 
  </body>
</html>  

<!-- #ajax onclick refresh for function calling without reload page -->

<!-- <a href="likes.php?other_id=$res_data[member_id]&post_id=$res_data[post_id]"> -->

<!-- #use of xmlhttprequest with ajax  -->


#problem what i think data echo ni hora, usko function call par echo na kawake retrieve kar yhi index par like
something get response aur fir dekh


<!-- #changing this 
                      $a="";
                      while($res_data1 = mysqli_fetch_assoc($all_comments)){
                          $comment_id = $res_data1['id'];

                          $a.= '<p>'.$res_data1['comment'].'</p>'.'<button onclick="onclick_btn_reply('.$comment_id.')">reply</button>';
                        } -->


                        <!-- "onclick_btn_reply('.$comment_id.','.$postid.')" -->


<!-- #do to do list project and comment reply system from scratch -->
                      