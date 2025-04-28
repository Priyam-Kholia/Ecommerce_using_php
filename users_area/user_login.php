<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css file-->
    <link rel="stylesheet" href="style.css">

    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center my-3">User Login</h2>
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!--username-->
                        <label for="user_username" class="form_label">Username</label>
                        <input type="text" class="form-control" name="user_username" id="user_username" placeholder="Enter username" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--password-->
                        <label for="user_password" class="form_label">Password</label>
                        <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter password" required="required">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" class="btn btn-info mb-3 px-3 py-2" name="user_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Dont have an account ? <a href="user_registration.php"> Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="Select * from `user_table` where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    // cart
    $user_ip=getIPAddress();
    $select_query_cart="Select * from `cart_details` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $row=mysqli_fetch_assoc($result);
        $user_password_db=$row['user_password'];
        $_SESSION['username']=$user_username;
        $hash_password=password_verify($user_password,$user_password_db);
        if($hash_password){
           // echo "<script>alert('Login successful')</script>";
            //echo "<script>window.open('./index.php','_self')</script>";
            if($row_count==1 and $row_count_cart==0){
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
        }else{
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('payment.php','_self')</script>";
        }   
        }
        else{
            echo "<script>alert('Invalid credentials')</script>";
        }
}
}

?>