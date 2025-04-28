<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Welcome <?php echo $_SESSION['username'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="../Images/SC1.png" class="logo" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../display_all.php">Products</a></li>
                        <?php
        if(!isset($_SESSION['username'])){
          echo"<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
        </li>";
        }else{ echo"<li class='nav-item'>
          <a class='nav-link' href='./users_area/profile.php'>My account</a>
        </li>";}
        ?>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php count_cart_items(); ?></sup></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                        <input type="submit" class="btn btn-outline-success" value="Search" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- Second Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <ul class="navbar-nav me-auto">
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome Guest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Header -->
        <div class="bg-light">
            <h3 class="text-center">Store</h3>
            <p class="text-center">Welcome to the Store</p>
        </div>

        <div class="row">
            <div class="col-md-2 ">
                <ul class="navbar-nav bg-light text-center" style="height: 100vh;">
                    <li class="nav-item text-light bg-secondary"><a class="nav-link" href="#">
                            <h4 class="text-light">Your Profile</h4>
                        </a></li>
                    <?php
                    $username = $_SESSION['username'];
                    $user_image = "SELECT * FROM user_table where username = '$username'";
                    $result_img = mysqli_query($con, $user_image);
                    $row_image = mysqli_fetch_array($result_img);
                    $user_image = $row_image['user_image'];
                    echo "<li class='nav-item'><img src='./user_images/$user_image' class='profile_img my-0' alt=''></li>";
                    ?>

                    <li class="nav-item"><a class="nav-link text-dark" href="profile.php">Pending Orders</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="profile.php?edit_account">Edit Account</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="profile.php?my_orders">My Orders</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="profile.php?delete_account">Delete Account</a></li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php get_user_order_details();
                if(isset($_GET['edit_account'])){
                  include('edit_account.php');  
                }if(isset($_GET['my_orders'])){
                    include('user_orders.php');  
                  }if(isset($_GET['delete_account'])){
                    include('delete_account.php');  
                  }
                 ?>
            </div>

        </div>

        <!-- Footer -->
        <?php include('../includes/footer.php'); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>