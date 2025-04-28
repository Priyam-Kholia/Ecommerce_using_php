<?php
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    $get_data="SELECT * FROM products WHERE product_id='$edit_id'";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_keyword = $row['product_keyword'];
    $product_description = $row['product_description'];
    $product_price = $row['product_price'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="product_title" value="<?php echo $product_title; ?>" id="product_title" aria-label="product_title" aria-describedby="basic-addon1" required="required">
            </div>
            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product Description</label>
                <input type="text" class="form-control" name="product_description" value="<?php echo $product_description; ?>" id="product_description"  aria-label="product_description" aria-describedby="basic-addon1">
            </div>
            <!--keyword-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" class="form-control" name="product_keyword" value="<?php echo $product_keyword; ?>" id="product_keyword"  aria-label="product_keyword" aria-describedby="basic-addon1">
            </div>
            <!--categories-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_categories" class="form-label">Product Categories</label>
                <select type="text" class="form-control" name="product_categories" value="<?php echo $product_categories; ?>" id="product_categories"  aria-label="product_categories" aria-describedby="basic-addon1">
                    <option value="">Select Categories</option>
                    <?php
                    include('../includes/connect.php');
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
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
                <select type="text" class="form-control" name="product_brands" value="<?php echo $product_brands; ?>" id="product_brands"  aria-label="product_brands" aria-describedby="basic-addon1">
                    <option value="">Select brands</option>
                    <?php
                    include('../includes/connect.php');
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" name="product_price" value="<?php echo $product_price; ?>"  aria-label="product_price" aria-describedby="basic-addon1">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_images1" class="form-label">Product Image 1</label>
                <div class="d-flex">
                <input type="file" class="form-control  bg-secondary text-white " name='product_image1' id='product_image1'>
                <img src="../admin_area/product_images/<?php echo $product_image1?>" class="product_img" alt="">
                </div>
                
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_images2" class="form-label">Product Image 2</label>
                <div class="d-flex">
                <input type="file" class="form-control  bg-secondary text-white " name='product_image2' id='product_image2'>
                <img src="../admin_area/product_images/<?php echo $product_image2?>" class="product_img" alt="">
                </div>
                
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_images3" class="form-label">Product Image 3</label>
                <div class="d-flex">
                <input type="file" class="form-control  bg-secondary text-white " name='product_image3' id='product_image3'>
                <img src="../admin_area/product_images/<?php echo $product_image3?>" class="product_img" alt="">
                </div>
                
            </div>
            <div class='form-outline mb-4 w-50 m-auto'>
                <input type='submit' class='btn btn-info mb-3 px-3 ' name='edit_product' value='Update Product'>
            </div>
        </form>
    </div>

                <!--editing products-->
                <?php
                if(isset($_POST['edit_product'])){
                    $product_title=$_POST['product_title'];
                    $product_description=$_POST['product_description'];
                    $product_keyword=$_POST['product_keyword'];
                    $product_categories=$_POST['product_categories'];
                    $product_brands=$_POST['product_brands'];
                    $product_price=$_POST['product_price'];
                    //getting images
                    $product_image1=$_FILES['product_image1']['name'];
                    $product_image2=$_FILES['product_image2']['name'];
                    $product_image3=$_FILES['product_image3']['name'];

                    //getting the temp names
                    $temp_image1=$_FILES['product_image1']['tmp_name'];
                    $temp_image2=$_FILES['product_image2']['tmp_name'];
                    $temp_image3=$_FILES['product_image3']['tmp_name'];

                    if($product_title=='' or $product_description=='' or $product_keyword=='' or $product_categories=='' or $product_brands=='' or $product_price=='' or $product_image1=='' or $product_image2=='' or $product_image3==''){
                        echo "<script>alert('Please fill all the fields')</script>";
                    }else{
                    move_uploaded_file($temp_image1,"./product_images/$product_image1");
                    move_uploaded_file($temp_image2,"./product_images/$product_image2");
                    move_uploaded_file($temp_image3,"./product_images/$product_image3");

                    //update query
                    $update_query="UPDATE `products` SET product_title='$product_title', product_description='$product_description', product_keyword='$product_keyword', category_id='$product_categories', brand_id='$product_brands', product_price='$product_price', product_image1='$product_image1', product_image2='$product_image2', product_image3='$product_image3', date=NOW() WHERE product_id='$edit_id'";

                    
                    $result_query=mysqli_query($con,$update_query);
                    if($result_query){
                        echo "<script>alert('Product updated successfully')</script>";
                        echo "<script>window.open('index.php?view_products','_self')</script>";
                    }
                }
                    }
                        

                    //updating the products
                    
                ?>
</body>

</html>