<?php
if(isset($_GET['edit_category'])){
    $edit_id=$_GET['edit_category'];
    $get_data="SELECT * FROM categories WHERE category_id='$edit_id'";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $category_id = $row['category_id'];
    $category_title = $row['category_title'];
   
}
?>
<h1 class="text-center">Edit categories</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="category_title" class="form-label">Category Title</label>
                <input type="text" class="form-control" name="category_title" value="<?php echo $category_title; ?>" id="category_title" aria-label="category_title" aria-describedby="basic-addon1" required="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto text-center">
        <input type="submit" name="edit_category" class="btn btn-info px-3 mb-3" value="Update category">
    </div>
        </form>    

        <?php
                if(isset($_POST['edit_category'])){
                    $category_title=$_POST['category_title'];
                    if($category_title=='' ){
                        echo "<script>alert('Please fill the field')</script>";
                    }else{

                    //update query
                    $update_query="UPDATE `categories` SET category_title='$category_title' WHERE category_id='$edit_id'";

                    
                    $result_query=mysqli_query($con,$update_query);
                    if($result_query){
                        echo "<script>alert('Category updated successfully')</script>";
                        echo "<script>window.open('index.php?view_categories','_self')</script>";
                    }
                }
                    }
                        

                    //updating the category
                    
                ?>