<?php
if(isset($_GET['delete_order'])){
    $delete_id=$_GET['delete_order'];
    $delete_query="DELETE FROM orders WHERE order_id='$delete_id'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('order deleted successfully')</script>";
                        echo "<script>window.open('index.php?view_orders','_self')</script>";
    }
}
?>