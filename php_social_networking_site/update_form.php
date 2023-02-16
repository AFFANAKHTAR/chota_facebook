<?php
#updating data 
include 'crud.php';
$fetch_src = fetch_src;
$id1 = $_GET['id'];
$image_path1 = $_GET['image'];


$query = "SELECT * FROM `nf`.`image_crud2` WHERE id = $id1";
$res = mysqli_query($link,$query);
$res_data = mysqli_fetch_assoc($res);

?>


<form action="#" method="post" enctype="multipart/form-data">
    <h1>Update Your Profile</h1>
      <div class="formcontainer">
        <hr/>
        <div class="container">
          
          <label ><strong>name</strong></label>
          <input type="text" placeholder="Enter your Email" name="email" value="<?php
          echo $res_data['name'];?>"required>
          <label ><strong>price</strong></label>
          <input type="text" placeholder="Enter your price" name="price" value="<?php
          echo $res_data['price'];?>"required>
          <label ><strong>description</strong></label>
          <input type="text" placeholder="Enter your description" name="description" value="<?php
          echo $res_data['description'];?>"required>
          <label ><strong>image</strong></label>
          <img src="$fetch_src$res_data[image]" width="150px">
          <input type="file" name="upload" accept=".jpg.svg,.png,.jpeg" id="" placeholder="click to upload" class="custom-file-input" aria-describedby="fileHelpId"
          value="<?= $image_path1?>">
    
          <button type="submit" name="submit">update</button>
          </a> 
          
      </div>
      
    </form>


    <?php


    #update data

if(isset($_POST['submit'])){  
    
    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($link,$value);

        // $query = "INSERT INTO `nf`.``";
}
if(file_exists($_FILES['upload']['tmp_name']) || is_uploaded_file($_FILES['upload']['tmp_name'])){
    image_remove($res_data['image']);    
    $imgpath=image_upload($_FILES['upload']);
    $query = "UPDATE `nf`.`image_crud2` SET `name`='$_POST[name]',`price`='$_POST[price]',`description`='$_POST[description]',`image`='$imgpath' WHERE id = $id1";
}else{
    
    $query = "UPDATE `nf`.`image_crud2` SET `name`='$_POST[name]',`price`='$_POST[price]',`description`='$_POST[description]' WHERE id = $id1";
}

if(mysqli_query($link,$query)){
    header('Location:gallery.php?success=updated');
}else{
    header('Location:gallery.php?alert=update_failed');
}
}
?>




