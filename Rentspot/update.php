<?php
include "connection.php";
session_start();
error_reporting(0);

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$username = $_GET['user_name'];
$email = $_GET['email'];
$phone_number = $_GET['phone_number'];
$product_id = $_GET['product_id'];
$product_name = $_GET['product_name'];
$category = $_GET['category'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$amount = $_GET['amount'];
$description = $_GET['description'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Update | Rentspot</title>
    <link rel="stylesheet" href="update.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <div class="title">Sell Your Product</div>
        <div class="content">
            <form action="sell.php" method="POST" enctype="multipart/form-data">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" placeholder="Enter your name" name="user_name" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" placeholder="Enter your email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" placeholder="Enter your number" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Product Name</span>
                        <input type="text" placeholder="Enter your product name" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Category</span>
                        <input type="text" placeholder="Ex. Musical, Sports..." name="category" value="<?php echo htmlspecialchars($category); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Available From</span>
                        <input type="text" placeholder="Ex. 12/12/2004" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Available Till</span>
                        <input type="text" placeholder="Ex. 12/12/2004" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Amount</span>
                        <input type="text" placeholder="Ex. 120/Day or 150/week" name="amount" value="<?php echo htmlspecialchars($amount); ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Description</span>
                        <textarea name="description" cols="44" rows="3" placeholder="Enter within 250 characters" required><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                    <div class="input-box1">
                        <span class="details">Upload Image</span>
                        <input type="file" name="screenshot" required>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" name="submit">Submit</button>
                </div>
                <!-- Pass product_id to the form to use in the update query -->
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            </form>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit']) && isset($_FILES['screenshot'])) {

    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    // $product_id = $_POST['product_id'];

    $img_name = $_FILES['screenshot']['name'];
    $img_size = $_FILES['screenshot']['size'];
    $tmp_name = $_FILES['screenshot']['tmp_name'];
    $error = $_FILES['screenshot']['error'];

    if ($error === 0) {
        if ($img_size > 125000) { // Adjusted file size to 125 KB for example
            $em = "Sorry, your file is too large.";
            echo $em;
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Update Database
                $sql = "UPDATE products SET user_name=?, email=?, phone_number=?, product_name=?, category=?, from_date=?, to_date=?, amount=?, description=?, image=? WHERE product_id=?";
                $sql1 = "UPDATE userselling SET user_name=?, email=?, phone_number=?, product_name=?, category=?, from_date=?, to_date=?, amount=?, description=?, image=? WHERE product_id=?";
                $stmt = $conn->prepare($sql);
                $stmt1 = $conn->prepare($sql1);
                $stmt->bind_param("ssssssssssi", $user_name, $email, $phone_number, $product_name, $category, $from_date, $to_date, $amount, $description, $new_img_name, $product_id);
                $stmt1->bind_param("ssssssssssi", $user_name, $email, $phone_number, $product_name, $category, $from_date, $to_date, $amount, $description, $new_img_name, $product_id);

                if ($stmt->execute() && $stmt1->execute()) {
                    echo "<script>alert('Record updated successfully');</script>";
                    header('Location: home.php');
                } else {
                    echo "Error: " . $stmt->error;
                    echo "Error: " . $stmt1->error;
                }
                $stmt->close();
                $stmt1->close();
            } else {
                $em = "You can't upload files of this type";
                echo $em;
            }
        }
    } else {
        $em = "Unknown error occurred!";
        echo $em;
    }
} else {
    // echo "Form not submitted properly.";
}
?>
