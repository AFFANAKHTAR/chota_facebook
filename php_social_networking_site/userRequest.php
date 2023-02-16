
<?php

include 'core.inc.php';


if(!loggedin())
{
    
    header('Location: login_form.php');
}
$query=mysqli_query($link,"SELECT * FROM nf.users inner JOIN nf.users_update ON users.id = users_update.member_id")or die(mysqli_error($link));




?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
  rel="stylesheet"
/>
<style>
    body {
background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
main {
padding-left: 240px;
}
}

/* Sidebar */
.sidebar {
position: fixed;
top: 0;
bottom: 0;
left: 0;
padding: 58px 0 0; /* Height of navbar */
box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
width: 240px;
z-index: 600;
}

@media (max-width: 991.98px) {
.sidebar {
width: 100%;
}
}
.sidebar .active {
border-radius: 5px;
box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
position: relative;
top: 0;
height: calc(100vh - 48px);
padding-top: 0.5rem;
overflow-x: hidden;
overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}
</style>
</head>
<body>
    <!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Update Profile Request</span>
        </a>
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
        <img src="img/adminlogo.png" height="25" alt="MDB Logo"
          loading="lazy" />
      </a>
   
      <!-- Right links -->
       
        
        <!-- Avatar -->
        
          <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
            id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img src="img/admin.png" class="rounded-circle"
              height="30" alt="Avatar" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            
              <li>
                <a class="dropdown-item" href="adminDashboard.php">Admin</a>
              </li>
            <li>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4">
  <table class="table align-middle">

  
      <?php
      while($row=mysqli_fetch_array($query)){
      $user_details_col=$row['user_details'];
      $userdetails=json_decode($user_details_col);
      $user_details_update=$row['user_details_update'];
      $userdetails_update=json_decode($user_details_update);?>


      <thead>
      <tr>
        <th scope="col">Member Id</th>
        <th scope="col">Username</th>
        <th scope="col">email</th>
        <th scope="col">New Details</th>
        <th scope="col">old details</th>
        <th scope="col">action</th>
      </tr>
      </thead>
      <tr>
<?php



    echo "<td>" . $row['member_id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . "First Name: $userdetails_update->first_name<br>
    Last Name: $userdetails_update->last_name<br>Building no.: $userdetails_update->building_no<br>City: $userdetails_update->city<br>State: $userdetails_update->state<br>Country: $userdetails_update->country<br>"
    . "</td>";
    echo "<td>" . "First Name: $userdetails->first_name<br>
    Last Name: $userdetails->last_name<br>Building no.: $userdetails->building_no<br>City: $userdetails->city<br>State: $userdetails->state<br>Country: $userdetails->country<br>"
    . "</td>";
    ?>
    
    <td>  <button style="  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;"
  ><a style="color:white; font-size:16px; text-decoration: none;" href="action.php/?id=<?= $row['member_id']?>&action=approve">Approve</a></button>
  <button style="  background-color:#d40d13;
  border: none;
  color: white;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;"
  ><a style="color:white; font-size:16px; text-decoration: none;" href="action.php/?id=<?= $row['member_id']?>&action=reject">Reject</a></button>

</td>
  <?php


}?>
  
  </tr>
  
 
  </tbody>
   </table>
  

  </div>
 
</main>
<!--Main layout-->
    
</body>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
></script>
</html>