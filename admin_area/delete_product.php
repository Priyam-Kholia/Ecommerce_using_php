<?php
if(isset($_GET['delete_product'])){
    $delete_id=$_GET['delete_product'];
    $delete_query="DELETE FROM products WHERE product_id='$delete_id'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Product deleted successfully')</script>";
                        echo "<script>window.open('index.php?view_products','_self')</script>";
    }
}
?>