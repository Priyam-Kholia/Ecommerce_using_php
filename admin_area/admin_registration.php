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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-stylesheet-->
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-4">
                <img src="../Images/adminregg.jpeg" alt="Admin Registration" class="img-fluid">

            </div>
            <div class="col-lg-6 col-xl-4 py-4">
                <form action="" method="post" enctype="multipart/form-data" c>
                    <div class="form-outline mb-4">
                        <!--username-->
                        <label for="admin_name" class="form_label">Admin name</label>
                        <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Enter Admin name" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--Email-->
                        <label for="admin_email" class="form_label">Admin email</label>
                        <input type="email" class="form-control" name="admin_email" id="admin_email" placeholder="Enter Admin email" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--password-->
                        <label for="admin_password" class="form_label">Admin password</label>
                        <input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Enter Admin password" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--confirm password-->
                        <label for="confirm_admin_password" class="form_label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_admin_password" id="confirm_admin_password" placeholder="Confirm password" required="required">
                    </div>
                    <div >
                        <button type="submit" class="btn btn-info mb-3 px-3 border-0" name="admin_registration">Register</button>
                        <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>

            </div>

        </div>
    </div>
</body>


</html>

<?php
if(isset($_POST['admin_registration'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $confirm_admin_password = $_POST['confirm_admin_password'];
    //password hashing
    $hash_admin_password = password_hash($admin_password, PASSWORD_DEFAULT);


    //select query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
    $result_query = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result_query);

    if ($row_count > 0) {
        echo "<script>alert('admin name or Email already exists')</script>";
    } else if ($admin_password != $confirm_admin_password) {
        echo "<script>alert('Password do not match')</script>";
    } else {
        //insert query
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password) VALUES ('$admin_name', '$admin_email', '$hash_admin_password')";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('admin registered successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>