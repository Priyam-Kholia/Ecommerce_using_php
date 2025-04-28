<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';
    // accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];
    // accessing temp names
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];
    // Check if the product title is empty
    if ($product_title == '' or $product_description == '' or $product_keyword == '' or $product_categories == '' or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == '') {
        echo "<script>alert('Please fill in all the fields.')</script>";
        
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");
        // Insert the product into the database
        $insert_query = "INSERT INTO `products` (product_title, product_description, product_keyword, category_id, brand_id, product_price, product_image1, product_image2, product_image3, date, status ) VALUES ('$product_title', '$product_description', '$product_keyword', '$product_categories', '$product_brands', '$product_price', '$product_image1', '$product_image2', '$product_image3', NOW(), '$product_status')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Product inserted successfully.')</script>";
        } else {
            echo "<script>alert('Error inserting product.')</script>";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-stylesheet-->
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
<!--form-->
        <form action="" method="post" class="mb-2" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Product Title" aria-label="product_title" aria-describedby="basic-addon1">
            </div>
            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" class="form-control" name="product_description" id="product_description" placeholder="Product description" aria-label="product_description" aria-describedby="basic-addon1">
            </div>
            <!--keyword-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" class="form-control" name="product_keyword" id="product_keyword" placeholder="Product keyword" aria-label="product_keyword" aria-describedby="basic-addon1">
            </div>
            <!--categories-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_categories" class="form-label">Product Categories</label>
                <select type="text" class="form-control" name="product_categories" id="product_categories" placeholder="Product categories" aria-label="product_categories" aria-describedby="basic-addon1">
                    <option value="">Select Categories</option>
                    <?php
                        include('../includes/connect.php');
                        $select_query = "SELECT * FROM `categories`";
                        $result_query = mysqli_query($con, $select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                </select>
                    </div>    
                <!--brands-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_brands" class="form-label">Product Brands</label>
                <select type="text" class="form-control" name="product_brands" id="product_brands" placeholder="Product brands" aria-label="product_brands" aria-describedby="basic-addon1">
                    <option value="">Select brands</option>
                    <?php
                        include('../includes/connect.php');
                        $select_query = "SELECT * FROM `brands`";
                        $result_query = mysqli_query($con, $select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" name="product_price" placeholder="Product Price" aria-label="product_price" aria-describedby="basic-addon1">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_images1" class="form-label">Product Image 1</label>
                <input type="file" class="form-control  bg-secondary text-white " name='product_image1' id='product_image1'>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_images2" class="form-label">Product Image 2</label>
                <input type="file" class="form-control  bg-secondary text-white " name='product_image2' id='product_image2'>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_images3" class="form-label">Product Image 3</label>
                <input type="file" class="form-control  bg-secondary text-white " name='product_image3' id='product_image3'>
            </div>
            <div class='form-outline mb-4 w-50 m-auto'>
                <input type='submit' class='btn btn-info mb-3 px-3 ' name='insert_product' value='Insert Product'>
            </div>
        </form>
    </div>

</body>