<?php
if(isset($_GET['delete_payment'])){
    $delete_id=$_GET['delete_payment'];
    $delete_query="DELETE FROM user_payments WHERE payment_id='$delete_id'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('payment deleted successfully')</script>";
                        echo "<script>window.open('index.php?view_payments','_self')</script>";
    }
}
?>