<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered-mt-5">
        <thead class="bg-info">
            <tr class="text-center">
            <th>SL No</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-center text-light">
        <?php
            $get_products="SELECT * FROM categories";
            $result=mysqli_query($con,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc(($result))){
                $category_id=$row['category_id'];
                $category_title=$row['category_title'];
                $number ++;
            
                ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $category_title; ?></td>
                <td><a href='index.php?edit_category=<?php echo $category_id?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_category=<?php echo $category_id?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>