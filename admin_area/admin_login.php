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
    <title>Admin Login</title>
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
        <h2 class="text-center mb-5">Admin Login</h2>

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-4">
                <img src="../Images/adminreg.png" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4 py-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <!--username-->
                        <label for="admin_name" class="form_label">Admin name</label>
                        <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Enter Admin name" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <!--password-->
                        <label for="admin_password" class="form_label">Admin Password</label>
                        <input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Enter Admin password" required="required">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-info mb-3 px-3 border-0" name="admin_login">Login</button>
                        <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php" class="link-danger">Register</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>

<?php
// Check if the form is submitted
if(isset($_POST['admin_login'])) {
    // Use isset to check if the form values are set
    if(isset($_POST['admin_name']) && isset($_POST['admin_password'])) {
        $admin_name = $_POST['admin_name'];
        $admin_password = $_POST['admin_password'];

        $select_query = "SELECT * FROM `admin_table` WHERE admin_name = '$admin_name'";
        $result = mysqli_query($con, $select_query);
        $row_count = mysqli_num_rows($result);

        if ($row_count > 0) {
            $row = mysqli_fetch_assoc($result);
            $admin_password_db = $row['admin_password'];
            $_SESSION['admin_name'] = $admin_name;
            $hash_password = password_verify($admin_password, $admin_password_db);

            if ($hash_password) {
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo "<script>alert('Invalid credentials')</script>";
            }
        } else {
            echo "<script>alert('Admin not found')</script>";
        }
    } else {
        echo "<script>alert('Please fill in both fields')</script>";
    }
}
?>
