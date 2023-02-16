<?php
require 'db_connect.php';
session_start();
?>
<?php

#create image_crud
function image_upload($img){
    
    $name = random_int(11111,99999).$img['name'];

    $strpos = strpos($name,'.');
    $extension = strtolower(substr($name,$strpos + 1));
    
    $size = $img['size'];
    $max_size = 2e+6;
    $type = $img['type'];
    
    #as files got saved at temp location 
    $tmp_location = $img['tmp_name'];
    
    
    if(isset($name)){
        if(!empty($name)){
            // if(($extension=='jpg'||$extension=='jpeg' || $extension =='png') && $size<=$max_size){#restricting file extensions
                    #$type=='image/jpeg'
                #dynamic ,remove backfolder dependancy.
                $permanent_location = uploads_src.$name;
    
               if(move_uploaded_file($tmp_location,$permanent_location)){
                     echo 'uploaded'."<br>"; 
                    return $name;
                }
                else
                {
                    echo 'please choose a file';
                    header('Location: gallery.php?alert=img_upload');
                }
            //}
        }
    }
    
    
}
?>


<?php
if(isset($_POST['addproduct'])){
 
    foreach($_POST as $key => $value){
    $_POST[$key] = mysqli_real_escape_string($link,$value);
 }
 

$image_path = image_upload($_FILES['upload']);
echo $image_path;
mysqli_select_db($link,'nf');
$user_id = $_SESSION['user_id'];
$query = "INSERT INTO `image_crud2`(`member_id`,`name`, `price`, `description`, `image`,`post`) VALUES ('$user_id','$_POST[name]','$_POST[price]','$_POST[desc]','$image_path','$_POST[post]')";
if(mysqli_query($link,$query)){
    header('Location: gallery.php?success=added');
}
else{
    header("Location: gallery.php?alert=add_failed");
}
}


// #reading data function
function image_remove($img){
    if(!unlink(uploads_src.$img)){
        header('Location:gallery.php?alert=img_rem_fail');
        exit; 
    }
}


if(isset($_GET['rem']) && $_GET['rem']>0){
    $id = $_GET['rem'];
    $query = "SELECT * FROM `nf`.`image_crud2` WHERE id = $id";
    $res = mysqli_query($link,$query);
    $res_data = mysqli_fetch_assoc($res);
    $image = $res_data['image'];
    image_remove($image);

    $query = "DELETE FROM `nf`.`image_crud2` WHERE id = $id";
    if($res = mysqli_query($link,$query)){
        header('Location: gallery.php?success=removed');
    }else{
        header('Location: gallery.php?alert=img_removed_fail');
    }

}


?>