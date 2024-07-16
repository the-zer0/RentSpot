<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="myproducts.css">
    <title>Rentspot | Myproducts</title> 
</head>
<body>
    <div class="container">
         <h2>My Products</h2>
        <div class="forms">
            <div class="form login">
                <span class="title">Listed Products</span>
        
                <table border="1" cellspacing="2" cellpadding="10">
                    <tr>
                        <td>Product Name</td>
                        <td>Category</td>
                        <td>From Date</td>
                        <td>To Date</td>
                        <td>Amount</td>
                        <td>Description</td>
                        <td>Image</td>
                        <td>Actions</td>
                    </tr>
                    <?php 
                    include "connection.php";
                    $rows = mysqli_query($conn, "SELECT * FROM userselling WHERE email = '{$_SESSION['email']}'");
                    $total = mysqli_num_rows($rows);
                    if ($total != 0) {
                        while ($result = mysqli_fetch_assoc($rows)) {
                            $update_url = "update.php?"
                                . "user_name=" . urlencode($result['user_name'])
                                . "&email=" . urlencode($result['email'])
                                . "&phone_number=" . urlencode($result['phone_number'])
                                . "&product_name=" . urlencode($result['product_name'])
                                . "&category=" . urlencode($result['category'])
                                . "&from_date=" . urlencode($result['from_date'])
                                . "&to_date=" . urlencode($result['to_date'])
                                . "&amount=" . urlencode($result['amount'])
                                . "&description=" . urlencode($result['description']);
                            $delete_url = "delete.php?product_id=" . urlencode($result['product_id']);
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($result['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($result['category']); ?></td>
                                <td><?php echo htmlspecialchars($result['from_date']); ?></td>
                                <td><?php echo htmlspecialchars($result['to_date']); ?></td>
                                <td><?php echo htmlspecialchars($result['amount']); ?></td>
                                <td><?php echo htmlspecialchars($result['description']); ?></td>
                                <td><img src="uploads/<?php echo htmlspecialchars($result['image']); ?>" width="100" title="<?php echo htmlspecialchars($result['image']); ?>"></td>
                                <td>
                                    <a href="<?php echo $update_url; ?>">Update</a>
                                    <a href="<?php echo $delete_url; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='8'>No data found</td></tr>";
                    }
                    ?>
                </table>
                
                <div class="login-signup">
                    <span class="text">
                        <!-- <a href="#" class="text signup-link">Products took for rent</a> -->
                    </span>
                </div>
            </div>

            <div class="form signup">
                <span class="title">Bought Products</span>

                <table border="1" cellspacing="0" cellpadding="10">
                    <tr>
                        <td>Product Name</td>
                        <td>Category</td>
                        <td>From Date</td>
                        <td>To Date</td>
                        <td>Amount</td>
                        <td>Description</td>
                        <td>Image</td>
                    </tr>
                    <?php 
                    $rows = mysqli_query($conn, "SELECT * FROM userbuying WHERE taker_email = '{$_SESSION['email']}'");
                    $total = mysqli_num_rows($rows);
                    if ($total != 0) {
                        while ($result = mysqli_fetch_assoc($rows)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($result['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($result['category']); ?></td>
                                <td><?php echo htmlspecialchars($result['from_date']); ?></td>
                                <td><?php echo htmlspecialchars($result['to_date']); ?></td>
                                <td><?php echo htmlspecialchars($result['amount']); ?></td>
                                <td><?php echo htmlspecialchars($result['description']); ?></td>
                                <td><img src="uploads/<?php echo htmlspecialchars($result['image']); ?>" width="100" title="<?php echo htmlspecialchars($result['image']); ?>"></td>
                            </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='7'>No data found</td></tr>";
                    }
                    ?>
                </table>

                <div class="login-signup">
                    <span class="text">
                        <!-- <a href="#" class="text login-link">Listed products for rent</a> -->
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script src="myproducts.js"></script>
</body>
</html>
