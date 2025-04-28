<?php
if(isset($_GET['edit_brand'])){
    $edit_id=$_GET['edit_brand'];
    $get_data="SELECT * FROM brands WHERE brand_id='$edit_id'";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $brand_id = $row['brand_id'];
    $brand_title = $row['brand_title'];
   
}
?>
<h1 class="text-center">Edit Brand</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-outline mb-4 w-50 m-auto">
        <label for="brand_title" class="form-label">Brand Title</label>
        <input type="text" class="form-control" name="brand_title" value="<?php echo $brand_title; ?>" id="brand_title" aria-label="brand_title" aria-describedby="basic-addon1" required="required">
    </div>

    <div class="form-outline mb-4 w-50 m-auto text-center">
        <input type="submit" name="edit_brand" class="btn btn-info px-3 mb-3" value="Update Brand">
    </div>
</form>

<?php
                if(isset($_POST['edit_brand'])){
                    $brand_title=$_POST['brand_title'];
                    if($brand_title=='' ){
                        echo "<script>alert('Please fill the field')</script>";
                    }else{

                    //update query
                    $update_query="UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id='$edit_id'";

                    
                    $result_query=mysqli_query($con,$update_query);
                    if($result_query){
                        echo "<script>alert('Brand updated successfully')</script>";
                        echo "<script>window.open('index.php?view_brands','_self')</script>";
                    }
                }
                    }
                        

                    //updating the category
                    
                ?>