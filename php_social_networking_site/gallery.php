<?php 
require ('db_connect.php');
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
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <style>
        /* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
    </style>
  </head>
  <body class="bg-light">
    <div class="container bg-dark text-light p-3 rounded my-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2>
                <a href="#" class ="text-white text-decoration-none" ><i class="bi bi-bar-chart-fill"></i>kiya rakha zindagi mai sab dhokha hai, crud samajhle beta mauka hai.</a>
            </h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addproduct1"><i class="bi bi-plus"></i>
            add post
            </button>
        </div>
    </div>    
<?php
if(isset($_GET['alert'])){
    if(isset($_GET['alert'])=='img_upload'){
        echo<<<alert
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>image not uploaded</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                alert;
    }

}
else if(isset($_GET['success'])){
    if(isset($_GET['success'])=='updated'){
        echo<<<alert
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>image succesfully uploaded</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;   
    }
}
?>
    

<!-- #read data from database and show it -->
    <div class="container mt-5" >
        <table class="table">
            <thead>
                <tr>
                    <th>name</th>
                    <th>price</th>
                    <th>description</th>
                    <th>image</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                $fetch_src = fetch_src;
                $query = "SELECT * FROM `nf`.`image_crud2` WHERE 1";
                $res = mysqli_query($link,$query);
                
                while($res_data = mysqli_fetch_assoc($res)){
                    
                    echo<<<product
                        <tr class="align-middle">
                        <td scope="row">$res_data[name]</td>
                        <td>$res_data[price]</td>
                        <td>$res_data[description]</td>
                        <td><img src="$fetch_src$res_data[image]" width="150px"></td>
                        <td>
                            <a href="update_form.php?id=$res_data[id] & image=$fetch_src$res_data[image]">
                            <button type="button" class="btn btn-success"><i class="bi bi-plus"></i>
                            edit product
                            </button>
                            </a> 
                            <button onclick="confirm_rem($res_data[id])" class="btn btn-danger">delete</button>
                        </td>
                    </tr>
                    product;
                }

                ?>

                <script>
                    function confirm_rem(id){
                        if(confirm("are you sure you want to delete this item ?")){
                            window.location.href="crud.php?rem="+id;
                        }
                    }
                </script>

            </tbody>
        </table>
    </div>



<!-- Modal -->
<div class="modal fade" id="addproduct1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
        <form action="crud.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">add product/h5>  
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label for="name"></label>
                    <small id="helpId" class="form-text text-muted">name</small>
                    <input type="text"
                        class="form-control" name="name" id="" aria-describedby="helpId" placeholder="enter your name" required>  
                </div>
                    
                <div class="form-group">
                <label for="price"></label>
                <small id="helpId" class="form-text text-muted">price</small>
                <input type="text"
                    class="form-control" name="price" id="" aria-describedby="helpId" placeholder="enter your price" min="1" required>      
                </div>

                <div class="form-group">
                <label for="textarea"></label>
                <textarea class="form-control" name="desc" id="" rows="3" required>description</textarea>
                </div><br>


                <div class="form-group">
                        <!-- Example single danger button -->
                        <select id="dropdown" name="post">                      
                            <option value="0">share with</option>
                            <option value="public">public</option>
                            <option value="friends">friends</option>
                            <option value="only_me">only me</option>
                        </select>

                </div><br>


                <div class="form-group">
                <label class="custom-file">
                    <small id="fileHelpId" class="form-text text-muted">upload</small>
                    <input type="file" name="upload" accept=".jpg.svg,.png,.jpeg" id="" placeholder="click to upload" class="custom-file-input" aria-describedby="fileHelpId">
                    <span class="custom-file-control"></span>
                </label>
                
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addproduct" class="btn btn-primary">add</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>




  </body>

</html>