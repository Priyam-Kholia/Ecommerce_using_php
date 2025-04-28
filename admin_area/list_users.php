<h1 class="text-center text-success">All users</h1>
    <table class="table table-bordered-mt-5">
        <thead class="bg-info">
            <tr class="text-center">
            <th>SL No</th>
            <th>Username</th>
            <th>User Email</th>
            <th>User Image</th>
            <th>User Address</th>
            <th>User Mobile</th>
            <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_users="SELECT * FROM user_table";
            $result=mysqli_query($con,$get_users);
            $number=0;
            while($row=mysqli_fetch_assoc(($result))){
                $user_id=$row['user_id'];
                $username=$row['username'];
                $user_email=$row['user_email'];
                $user_image=$row['user_image'];
                $user_address=$row['user_address'];
                $user_mobile=$row['user_mobile'];
                $number ++;
                ?>
                <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $username;?></td>
                <td><?php echo $user_email;?></td>
                <td><img src='../users_area/user_images/<?php echo $user_image; ?>' class='user_img' style='width: 50px; height: 50px; object-fit: cover;'/></td>
                <td><?php echo $user_address; ?>/-</td>
                <td><?php echo $user_mobile ;?></td>
                <td><a href='index.php?delete_user=<?php echo $user_id?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
            ?>
            
        </tbody>
    </table>