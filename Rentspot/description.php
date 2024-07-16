<?php
include "connection.php";
session_start();
error_reporting(0);
// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

$user_name = $_GET['user_name'];
$email = $_GET['email'];
$phone_number = $_GET['phone_number'];
$product_id = $_GET['product_id'];
$product_name = $_GET['product_name'];
$category = $_GET['category'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$amount = $_GET['amount'];
$description = $_GET['description'];
$image = $_GET['image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="description.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&display=swap" rel="stylesheet">
    <title>Product Card</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="shoeBackground">
                <!-- <img src="img/logo.png" alt="" class="logo"> -->
                <a href="#" class="share"><i class="fas fa-share-alt"></i></a>

                <img src="<?php echo "uploads/" . htmlspecialchars($image); ?>" class="shoe show">

            </div>
            <div class="info">
                <div class="shoeName">
                    <div>
                        <h1 class="big"><?php echo htmlspecialchars($product_name); ?></h1>
                        <span class="new">new</span>
                    </div>
                    <h3 class="small"><?php echo htmlspecialchars($category); ?></h3>
                    <h4 class="small">By <?php echo htmlspecialchars($user_name); ?></h4>
                </div>
                <div class="description">
                    <h3 class="title">Product Info</h3>
                    <p class="text"><?php echo htmlspecialchars($description); ?></p>
                </div>
                <div class="size-container">
                    <h3 class="title">Available</h3>
                    <div class="sizes">
                        <span class="size">From</span>
                        <span class="size"><?php echo htmlspecialchars($from_date); ?></span>
                        <span class="size">To</span>
                        <span class="size"><?php echo htmlspecialchars($to_date); ?></span>
                    </div>
                </div>
                <div class="buy-price">
                    <a href="info_share.php?email=<?= htmlspecialchars($email) ?>&phone_number=<?= htmlspecialchars($phone_number) ?>&product_id=<?= htmlspecialchars($product_id) ?>&product_name=<?= htmlspecialchars($product_name) ?>&category=<?= htmlspecialchars($category) ?>&from_date=<?= htmlspecialchars($from_date) ?>&to_date=<?= htmlspecialchars($to_date) ?>&amount=<?= htmlspecialchars($amount) ?>&description=<?= htmlspecialchars($description) ?>&image=<?= htmlspecialchars($image) ?>" class="buy">
                        <i class="fas fa-shopping-cart"></i>Rent
                    </a>
                    <div class="price">
                        <i class="fas fa-rupee-sign"></i>
                        <h1><?= htmlspecialchars($amount) ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="suggestions" style="background:#fff; padding: 10px">
        <h3 style="margin-top: 3%;margin-bottom: 2%;display: flex; align-items: center; justify-content: center;font-size: 2.5rem;">Related Products</h3>
        <table>
            <?php
            include "connection.php";
            $searchTerm = htmlspecialchars($category);
            $searchCondition = "WHERE product_name LIKE '%$product_name%' OR category LIKE '%$searchTerm%'";

            $sql = "SELECT * FROM products $searchCondition";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($count % 6 == 0) {
                        echo "<tr>";
                    }
                    echo "<td>
                    <div class='card1'>
                        <div class='imgBx'>
                            <img src='uploads/" . htmlspecialchars($row["image"]) . "'>
                        </div>
                        <div class='contentBx'>
                            <h3>" . htmlspecialchars($row["product_name"]) . "</h3>
                            <h2 class='price'>" . htmlspecialchars($row["amount"]) . "</h2>
                            <a href='description.php?user_name=" . htmlspecialchars($row["user_name"]) . "&email=" . htmlspecialchars($row["email"]) . "&phone_number=" . htmlspecialchars($row["phone_number"]) . "&product_name=" . htmlspecialchars($row["product_name"]) . "&category=" . htmlspecialchars($row["category"]) . "&from_date=" . htmlspecialchars($row["from_date"]) . "&to_date=" . htmlspecialchars($row["to_date"]) . "&amount=" . htmlspecialchars($row["amount"]) . "&description=" . htmlspecialchars($row["description"]) . "&image=" . htmlspecialchars($row["image"]) . "' class='buy' style='margin-top:35px;'>Rent Now</a>
                        </div>
                    </div>
                </td>";
                    if ($count % 6 == 5 || $count == $result->num_rows - 1) {
                        echo "</tr>";
                    }
                    $count++;
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </table>
    </div>

    <script>
        let x = window.matchMedia("(max-width: 1000px)");
        function changeHeight() {
            if (x.matches) {
                let shoeHeight = shoes[0].offsetHeight;
                shoeBg.style.height = `${shoeHeight * 0.9}px`;
            } else {
                shoeBg.style.height = "475px";
            }
        }
        changeHeight();
        window.addEventListener('resize', changeHeight);
    </script>
</body>
</html>
