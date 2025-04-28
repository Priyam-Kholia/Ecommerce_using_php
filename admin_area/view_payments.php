<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View payments</title>
</head>
<body>
    <h1 class="text-center text-success">All payments</h1>
    <table class="table table-bordered-mt-5">
        <thead class="bg-info">
            <tr class="text-center">
            <th>SL No</th>
            <th>Invoice Number</th>
            <th>Amount</th>
            <th>Payment Mode</th>
            <th>Order Date</th>
            <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_payments="SELECT * FROM user_payments";
            $result=mysqli_query($con,$get_payments);
            $number=0;
            while($row=mysqli_fetch_assoc(($result))){
                $order_id=$row['order_id'];
                $amount=$row['amount'];
                $invoice_number=$row['invoice_number'];
                $payment_mode=$row['payment_mode'];
                $date=$row['date'];
                $number ++;
                ?>
                <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $invoice_number; ?></td>
                <td><?php echo $amount;?></td>
                <td><?php echo $payment_mode; ?></td>
                <td><?php echo $date;?></td>
                <td><a href='index.php?delete_payment=<?php echo $order_id?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
            ?>
            
        </tbody>
    </table>