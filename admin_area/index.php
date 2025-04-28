<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-stylesheet-->
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../Images/SC1.png" class="logo" alt="">
                <nav class="navbar navbar-expand-lg navbar-light bg-info">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <?php if (isset($_SESSION['admin_name'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Welcome <p class="text-light text-center">
                                            <?php
                                            if (isset($_SESSION['admin_name'])) {
                                                echo htmlspecialchars($_SESSION['admin_name']);
                                            } else {
                                                echo "Guest";
                                            }
                                            ?>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_logout.php">Logout</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Welcome Guest</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin_login.php">Login</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?view_products">View Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?list_orders">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?list_users">Customers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?view_payments">Reports</a>
                            </li>
                        </ul>
                </nav>
            </div>
        </nav>
        <!--Second child-->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!--third child-->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex justify-content-center align-items-center ">
                <div class="p-3">
                    <a href="#"><img src="../Images/Screenshot 2024-09-01 230048.png" alt="" class="admin-img"></a>
                    <p class="text-light text-center">
                    <p class="text-light text-center">
                        <?php
                        if (isset($_SESSION['admin_name'])) {
                            echo htmlspecialchars($_SESSION['admin_name']);
                        } else {
                            echo "Guest";
                        }
                        ?>
                    </p>
                    </p>
                </div>
                <div class="button text-center">
                    <!--button*10>a.nav-link.text-light.bg-info.my-1-->
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1">View Categories</a></button>
                    <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light bg-info my-1">View Brands</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-info my-1">All Orders</a></button>
                    <button><a href="index.php?view_payments" class="nav-link text-light bg-info my-1">All Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1">List Users</a></button>
                </div>
            </div>
        </div>
        <!--fourth child-->
        <div class="container my-3">
            <?php
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['insert_brand'])) {
                include('insert_brands.php');
            }
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            if (isset($_GET['delete_product'])) {
                include('delete_product.php');
            }
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if (isset($_GET['view_brands'])) {
                include('view_brands.php');
            }
            if (isset($_GET['edit_category'])) {
                include('edit_category.php');
            }
            if (isset($_GET['edit_brand'])) {
                include('edit_brand.php');
            }
            if (isset($_GET['delete_category'])) {
                include('delete_category.php');
            }
            if (isset($_GET['delete_brand'])) {
                include('delete_brand.php');
            }
            if (isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            if (isset($_GET['delete_order'])) {
                include('delete_order.php');
            }
            if (isset($_GET['view_payments'])) {
                include('view_payments.php');
            }
            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }
            if (isset($_GET['delete_user'])) {
                include('delete_user.php');
            }



            ?>
        </div>



        <!--last child-->
        <?php include('../includes/footer.php'); ?>
    </div>

    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>