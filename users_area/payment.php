<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="../style.css">
</head>
<style>
   img{
    width: 90%;
    margin:auto;
    display:block;
   }
</style>

<body>
    <?php
    $user_ip=getIPAddress();
    $get_user="SELECT * FROM user_table WHERE user_ip='$user_ip'";
    $result=mysqli_query($con,$get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query['user_id'];
    ?>
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
                        <li class="nav-item"><a class="nav-link" href="user_registration.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php count_cart_items(); ?></sup></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Second Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <ul class="navbar-nav me-auto">
    <?php if(isset($_SESSION['username'])): ?>
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

        <div class="container">
            <h2 class="text-center text-info">Payment options</h2>
            <div class="row d-flex justify-content-center align-items-center my-5">
                <div class="col-md-6">
                <a href="https://www.google.com/search?q=googlepay&rlz=1C1CHZN_enIN970IN970&oq=googlepay&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIJCAEQABgKGIAEMgwIAhAAGAoYiwMYgAQyDAgDEAAYChiLAxiABDIJCAQQABgKGIAEMgwIBRAAGAoYiwMYgAQyDAgGEAAYChiLAxiABDIMCAcQABgKGIsDGIAEMgwICBAAGAoYiwMYgAQyDAgJEAAYChiLAxiABNIBCDI4MDZqMWo3qAIAsAIA&sourceid=chrome&ie=UTF-8" target="_blank"><img src="../Images/UPI.jpeg" alt=""></a>
                </div>
                <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>" ><h2 class="text-center">Cash on Delivery</h2></a>
                </div>
                
            </div>
        </div>


        <!-- Footer -->
        <?php include('../includes/footer.php'); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
