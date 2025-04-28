<?php
include('../includes/connect.php');
if(isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    //select data from database
    $select_query = "SELECT * FROM `brands` WHERE brand_title='$brand_title'";
    $result_select = mysqli_query($con, $select_query);
    $number_of_rows = mysqli_num_rows($result_select);
    if ($number_of_rows > 0) {
        echo "<script>alert('This brand is already present in the database.')</script>";
    } else {
        // Check if the brand title is empty
        if ($brand_title == '') {
            echo "<script>alert('Please fill in the brand title.')</script>";
        } else {
            // Insert the brand into the database
            $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
            $result = mysqli_query($con, $insert_query);
            if ($result) {
                echo "<script>alert('Brand inserted successfully.')</script>";
            } else {
                echo "<script>alert('Error inserting brand.')</script>";
            }
        }
    }
}
?>
<h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="brands" aria-describedby="basic-addon1">
</div>
<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brand" value="Insert Brands">
  
</div>
</form>