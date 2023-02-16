<?php
require 'core.inc.php';

$res_data = get_all_friends($link);
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
                $query = "SELECT * FROM `nf`.`image_crud2` WHERE `member_id`=$res_data[id] ";
                $res1 = mysqli_query($link,$query);
                $res_data1 = mysqli_fetch_assoc($res1);

                    
                echo<<<product
                    <tr class="align-middle">
                    <td scope="row">$res_data[username]</td>
                    <td><img src="$fetch_src$res_data1[image]" width="150px"></td>
                    <td><button><a href="action_friends.php?id=$res_data[id]&action=unfriend">unfriend</a></button></td>
                    </tr>
                product;

             
                ?>
            </tbody>
        </table>
    </div>
  </body>