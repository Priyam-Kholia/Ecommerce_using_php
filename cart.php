<?php
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();

// UPDATE logic
if (isset($_POST['update_cart']) && isset($_POST['qty'])) {
    $ip = getIPAddress();
    foreach ($_POST['qty'] as $product_id => $qty) {
        $qty = (int)$qty;
        if ($qty > 0) {
            $update_query = "UPDATE cart_details SET quantity = $qty WHERE product_id = $product_id AND ip_address = '$ip'";
            mysqli_query($con, $update_query);
        }
    }
    header("Location: cart.php");
    exit();
}

// REMOVE individual item
if (isset($_GET['remove_id'])) {
    $product_id = $_GET['remove_id'];
    $ip = getIPAddress();
    $remove_query = "DELETE FROM cart_details WHERE product_id = $product_id AND ip_address = '$ip'";
    mysqli_query($con, $remove_query);
    header("Location: cart.php");
    exit();
}

// REMOVE multiple items
if (isset($_POST['remove_selected']) && isset($_POST['removeitem'])) {
    $remove_items = $_POST['removeitem'];
    $ip = getIPAddress();
    foreach ($remove_items as $product_id) {
        $delete_query = "DELETE FROM cart_details WHERE product_id = $product_id AND ip_address = '$ip'";
        mysqli_query($con, $delete_query);
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img src="./Images/SC1.png" class="logo" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
        </li>";
                        } else {
                            echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/profile.php'>My account</a>
        </li>";
                        }
                        ?>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php count_cart_items(); ?></sup></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Second Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <ul class="navbar-nav me-auto">
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
           <a class='nav-link' href=''>Welcome " . $_SESSION['username'] . "</a>
        </li>";
                } else {
                    echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
          </li>";
                } else {
                    echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_logout.php'>Logout</a>
          </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- Header -->
        <div class="bg-light">
            <h3 class="text-center">Store</h3>
            <p class="text-center">Welcome to the Store</p>
        </div>

        <!-- Cart Table -->
        <div class="container">
            <div class="row">
                <form method="post" action="cart.php">
                    <table class="table table-bordered text-center">
                        <thead class="bg-info">
                            <tr>
                                <th>Product Title</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Select</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-light">
                            <?php
                            $ip = getIPAddress();
                            $total = 0;
                            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
                            $result = mysqli_query($con, $cart_query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = $row['product_id'];
                                    $quantity = $row['quantity'];

                                    $product_query = "SELECT * FROM `products` WHERE product_id='$product_id'";
                                    $product_result = mysqli_query($con, $product_query);
                                    $product_row = mysqli_fetch_assoc($product_result);

                                    if ($product_row) {
                                        $product_title = $product_row['product_title'];
                                        $product_image = $product_row['product_image1'];
                                        $product_price = $product_row['product_price'];
                                        $subtotal = $product_price * $quantity;
                                        $total += $subtotal;

                                        echo "
                                        <tr>
                                            <td>$product_title</td>
                                            <td><img src='./admin_area/product_images/$product_image' width='60px'></td>
                                            <td>
                                                <div class='d-flex flex-column align-items-center'>
                                                    <input type='number' name='qty[$product_id]' min='1' value='$quantity' class='form-control w-75'>
                                                </div>
                                            </td>
                                            <td>₹$subtotal</td>
                                            <td><input type='checkbox' name='removeitem[]' value='$product_id'></td>
                                            <td>
                                                <a href='cart.php?remove_id=$product_id' class='btn btn-danger btn-sm'>Remove</a>
                                            </td>
                                        </tr>";
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php if ($total > 0): ?>
                        <div class="text-center mb-4">
                            <h4>Grand Total: ₹<?php echo $total; ?></h4>
                        </div>

                        <div class="d-flex justify-content-center mb-4">
                            <button type="submit" name="update_cart" class="btn btn-warning mx-2">Update Quantities</button>
                            <button type="submit" name="remove_selected" class="btn btn-danger mx-2">Remove Selected</button>
                            <a href="index.php" class="btn btn-info mx-2">Continue Shopping</a>
                            <a href="./users_area/checkout.php" class="btn btn-success mx-2">Checkout</a>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <?php include('./includes/footer.php'); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>