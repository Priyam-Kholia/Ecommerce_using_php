<?php
if(isset($_GET['delete_category'])){
    $delete_id=$_GET['delete_category'];
    $delete_query="DELETE FROM categories WHERE category_id='$delete_id'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('category deleted successfully')</script>";
                        echo "<script>window.open('index.php?view_categories','_self')</script>";
    }
}
?>