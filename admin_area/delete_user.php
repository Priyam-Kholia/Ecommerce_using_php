<?php
if(isset($_GET['delete_user'])){
    $delete_id=$_GET['delete_user'];
    $delete_query="DELETE FROM users_table WHERE user_id='$delete_id'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('user deleted successfully')</script>";
                        echo "<script>window.open('index.php?list_users','_self')</script>";
    }
}
?>