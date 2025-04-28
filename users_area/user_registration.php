<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css file-->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center my-3">New User Registration</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!--username-->
                        <label for="user_username" class="form_label">Username</label>
                        <input type="text" class="form-control" name="user_username" id="user_username" placeholder="Enter username" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--Email-->
                        <label for="user_email" class="form_label">Email</label>
                        <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter email" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--Image-->
                        <label for="user_image" class="form_label">Image</label>
                        <input type="file" class="form-control" name="user_image" id="user_image" placeholder="Enter image" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--password-->
                        <label for="user_password" class="form_label">Password</label>
                        <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter password" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--confirm password-->
                        <label for="conf_user_password" class="form_label">Confirm Password</label>
                        <input type="password" class="form-control" name="conf_user_password" id="conf_user_password" placeholder="Confirm password" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--address-->
                        <label for="user_address" class="form_label">Address</label>
                        <input type="text" class="form-control" name="user_address" id="user_address" placeholder="Enter address" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--mobile-->
                        <label for="user_mobile" class="form_label">Mobile</label>
                        <input type="text" class="form-control" name="user_mobile" id="user_mobile" placeholder="Enter mobile number" required="required">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" class="btn btn-info mb-3 px-3 py-2" name="user_register" value="Register">
                        <p class="small fw-bold mt-2 pt-1">Already have an account ? <a href="user_login.php"> Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!--php-->
<?php
if(isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'] ?? '';
    $user_ip=getIPAddress();
    //password hashing
    $hash_user_password = password_hash($user_password, PASSWORD_DEFAULT);
    $hash_conf_user_password = password_hash($conf_user_password, PASSWORD_DEFAULT);


    //select query
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $result_query = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result_query);

    if ($row_count > 0) {
        echo "<script>alert('Username or Email already exists')</script>";
    } else if ($user_password != $conf_user_password) {
        echo "<script>alert('Password do not match')</script>";
    } else {
        //insert query
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_image, user_password, user_address, user_mobile, user_ip) VALUES ('$user_username', '$user_email', '$user_image', '$hash_user_password', '$user_address', '$user_mobile','$user_ip')";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('User registered successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
    // selecting cart items
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $result_query_cart = mysqli_query($con, $select_query_cart);
    $row_count = mysqli_num_rows($result_query_cart); 
    if($row_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('You have items in the cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('user_login.php','_self')</script>";
    }
}
?>