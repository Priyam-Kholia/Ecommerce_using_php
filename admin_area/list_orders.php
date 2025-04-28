<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
</head>
<body>
    <h1 class="text-center text-success">All Orders</h1>
    <table class="table table-bordered-mt-5">
        <thead class="bg-info">
            <tr class="text-center">
            <th>SL No</th>
            <th>Due Amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_orders="SELECT * FROM user_orders";
            $result=mysqli_query($con,$get_orders);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $order_id=$row['order_id'];
                $amount_due=$row['amount_due'];
                $invoice_number=$row['invoice_number'];
                $total_products=$row['total_products'];
                $order_date=$row['order_date'];
                $order_status=$row['order_status'];
                $number ++;
                ?>
                <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $amount_due;?></td>
                <td><?php echo $invoice_number; ?></td>
                <td><?php echo $total_products; ?></td>
                <td><?php echo $order_date;?></td>
                <td><?php echo $order_status ;?></td>
                <td><a href='index.php?delete_order=<?php echo $order_id?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
            ?>
            
        </tbody>
    </table>
</body>
</html>