<!--connect to database connect.php-->
<?php
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css file-->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!--navbar-->
<div class="container-fluid p-0">
<!--first child-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <img src="./Images/SC1.png" class="logo" alt="">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php
        if(!isset($_SESSION['username'])){
          echo"<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
        </li>";
        }else{ echo"<li class='nav-item'>
          <a class='nav-link' href='./users_area/profile.php'>My account</a>
        </li>";}
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php count_cart_items();?></sup></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price();?></a>
        </li>
        
      </ul>
      <form class="d-flex" action="" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
         <input type="submit" class="btn btn-outline-success" value="Search" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!--Second child-->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <ul class="navbar-nav me-auto">
        <?php
        if(isset($_SESSION['username'])){
          echo "<li class='nav-item'>
           <a class='nav-link' href=''>Welcome ".$_SESSION['username']."</a>
        </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
        }
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
          </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_logout.php'>Logout</a>
          </li>";
        }
        ?>
</ul>
</nav>


<!--Third child-->
<div class="bg-light">
<h3 class="text-center">Store</h3>
    <p class="text-center">Welcome to the Store</p>
</div>

<!--Fourth child-->
<div class="row px-1" >
   <div class="col-md-10">
<!--Products-->
<div class="row">
  <!--fetching products-->
 <?php
 search_product();
 get_unique_categories();
 get_unique_brands();
 cart();
//  $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;
  
  
  ?>

<!--row end-->
</div>
<!--col end-->
   </div>


<div class="col-md-2 bg-light p-0">
<!--Brands to Display-->
  <ul class="navbar-nav me-auto text-center">
    <li class="nav-item bg-secondary p-0">
      <a href="" class="nav-link text-light"><h4>Delivery Brands</h4></a>
    </li>
    <?php
    getbrands(); 
   
    ?>
    
  </ul>
<!--Categories to Display-->
<ul class="navbar-nav me-auto text-center">
    <li class="nav-item bg-secondary p-0">
      <a href="" class="nav-link text-light"><h4>Categories</h4></a>
    </li>
    <?php
     getcategories();
   
    ?>
  </ul>
    <!--SideNav-->
</div> 
</div>
    

<!--last child-->
<div class="bg-light p-3 text-center">
    <p>Designed by @- PK</p>
</div>


</div>


    



<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>